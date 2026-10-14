<?php
// NAMA FILE: app/Filament/Resources/PengajuanJudulResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanJudulResource\Pages;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\PengajuanJudul;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\JudulDiajukan;
use Filament\Forms\Components\Repeater;

class PengajuanJudulResource extends Resource
{
    protected static ?string $model = PengajuanJudul::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Pengajuan Judul';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Daftar Judul Diajukan')
                    ->schema([
                        Repeater::make('juduls') // Ini adalah nama relasi
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('deskripsi')
                                    ->label('Deskripsi Singkat')
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->minItems(3) // Minimal 3 judul
                            ->addActionLabel('Tambah Judul Lain')
                            ->defaultItems(3), // Default 3 form
                    ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        $query = parent::getEloquentQuery();

        if ($user->hasRole('mahasiswa')) {
            return $query->where('mahasiswa_id', $user->mahasiswa->id);
        }

        return $query;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nama_lengkap')
                    ->searchable()
                    ->sortable()
                    ->visible(fn (): bool => auth()->user()->hasRole('admin')),
                
                // INI FIX #2: Menampilkan Judul Diterima dari relasi baru
                Tables\Columns\TextColumn::make('judulDiterima.judul')
                    ->label('Judul Diterima')
                    ->limit(30)
                    ->tooltip(fn (Model $record) => $record->judulDiterima?->judul)
                    ->default('-'), // Data lama akan tampil sebagai '-'

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordAction(null)
            ->recordUrl(null)
            // INI FIX #1: Menyembunyikan tombol Admin dari Mahasiswa
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn (Model $record): bool => 
                        auth()->user()->hasRole('mahasiswa') && $record->status === 'pending'
                    ),
                
                Tables\Actions\Action::make('prosesPengajuan')
                    ->label('Proses Pengajuan')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->visible(fn (Model $record): bool => 
                        auth()->user()->hasRole('admin') && $record->status === 'pending'
                    )
                    ->form([
                        Select::make('judul_diterima_id')
                            ->label('Pilih Judul yang Disetujui')
                            ->options(fn (Model $record) => $record->juduls()->pluck('judul', 'id'))
                            ->required(),
                        Select::make('dosen_id')
                            ->label('Pilih Dosen Pembimbing')
                            ->options(fn () => Dosen::all()->pluck('nama_lengkap', 'id'))
                            ->searchable()
                            ->required(),
                        Select::make('penguji_id')
                            ->label('Pilih Dosen Penguji')
                            ->options(fn () => Dosen::all()->pluck('nama_lengkap', 'id'))
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data, Model $record) {
                        $judulDiterima = JudulDiajukan::find($data['judul_diterima_id']);
                        $record->update([
                            'status' => 'approved',
                            'judul_diterima_id' => $data['judul_diterima_id'],
                        ]);
                        Bimbingan::create([
                            'mahasiswa_id' => $record->mahasiswa_id,
                            'dosen_id' => $data['dosen_id'],
                            'pengajuan_judul_id' => $record->id,
                            'judul_disetujui' => $judulDiterima->judul,
                            'status' => 'aktif',
                            'penguji_id' => $data['penguji_id'],
                        ]);
                        
                        // Notifikasi
                        $dosenPembimbingUser = Dosen::find($data['dosen_id'])->user;
                        $dosenPengujiUser = Dosen::find($data['penguji_id'])->user;
                        $mahasiswaUser = $record->mahasiswa->user;

                        Notification::make()->title('Penetapan Pembimbing Berhasil')
                            ->body("Anda telah ditugaskan sebagai Dosen Pembimbing untuk {$mahasiswaUser->name}")
                            ->toDatabaseFormat() // <-- TAMBAHKAN INI
                            ->sendToDatabase($dosenPembimbingUser);
                        Notification::make()->title('Penetapan Penguji Berhasil')
                            ->body("Anda telah ditugaskan sebagai Dosen Penguji untuk {$mahasiswaUser->name}")
                            ->toDatabaseFormat() // <-- TAMBAHKAN INI
                            ->sendToDatabase($dosenPengujiUser);
                        Notification::make()->title('Judul Anda Disetujui!')
                            ->body("Judul '{$judulDiterima->judul}' telah disetujui.")
                            ->success() // <-- Bagus untuk menambah warna
                            ->toDatabaseFormat() // <-- TAMBAHKAN INI
                            ->sendToDatabase($mahasiswaUser);

                        
                        
                    }),
                
                Tables\Actions\Action::make('tolakPengajuan')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Model $record): bool => 
                        auth()->user()->hasRole('admin') && $record->status === 'pending'
                    )
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('catatan_admin')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (array $data, Model $record) {
                        $record->update([
                            'status' => 'rejected',
                            'catatan_admin' => $data['catatan_admin'],
                        ]);
                        Notification::make()->title('Pengajuan Judul Ditolak')
                            ->body("Mohon maaf, pengajuan judul Anda ditolak.")
                            ->danger() // <-- Bagus untuk menambah warna
                            ->toDatabaseFormat() // <-- TAMBAHKAN INI
                            ->sendToDatabase($record->mahasiswa->user);

                        
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengajuanJuduls::route('/'),
            'create' => Pages\CreatePengajuanJudul::route('/create'),
            'edit' => Pages\EditPengajuanJudul::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Skripsi';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'mahasiswa']);
    }
}