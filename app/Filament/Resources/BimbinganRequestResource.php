<?php
// NAMA FILE: app/Filament/Resources/BimbinganRequestResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\BimbinganRequestResource\Pages;
use App\Models\BimbinganRequest;
use Filament\Forms;
use Filament\Forms\Form; // <-- Pastikan Form di-use
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use App\Models\Bimbingan;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Carbon\Carbon; // <-- Pastikan Carbon di-use

class BimbinganRequestResource extends Resource
{
    protected static ?string $model = BimbinganRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    /**
     * Memeriksa jadwal bentrok untuk dosen, dengan asumsi durasi 1 jam.
     */
    private static function checkClash(int $dosenId, Carbon $proposedStartTime, int $excludeRequestId): bool
    {
        // Asumsi durasi 1 jam
        $proposedEndTime = $proposedStartTime->copy()->addHour(); 

        // Cari request lain yang beririsan
        return BimbinganRequest::whereHas('bimbingan', fn ($q) => $q->where('dosen_id', $dosenId))
            ->where('id', '!=', $excludeRequestId) // Jangan cek dengan diri sendiri
            ->whereIn('status', ['approved', 'reschedule']) // Hanya cek jadwal yg sudah 'jadi'
            ->where(function ($query) use ($proposedStartTime, $proposedEndTime) {
                
                // Cek bentrok dengan slot 'approved' (yang menggunakan tanggal_diajukan)
                $query->where(function ($q) use ($proposedStartTime, $proposedEndTime) {
                    $q->where('status', 'approved')
                      ->where('tanggal_diajukan', '<', $proposedEndTime)
                      ->whereRaw('DATE_ADD(tanggal_diajukan, INTERVAL 1 HOUR) > ?', [$proposedStartTime]);
                })
                // Cek bentrok dengan slot 'reschedule' (yang menggunakan tanggal_direvisi)
                ->orWhere(function ($q) use ($proposedStartTime, $proposedEndTime) {
                    $q->where('status', 'reschedule')
                      ->where('tanggal_direvisi', '<', $proposedEndTime)
                      ->whereRaw('DATE_ADD(tanggal_direvisi, INTERVAL 1 HOUR) > ?', [$proposedStartTime]);
                });

            })
            ->exists(); // Kembalikan true jika ada (bentrok)
    }


    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Skripsi';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'dosen', 'mahasiswa']);
    }

    // --- INI KODE YANG HILANG (FIX 1) ---
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        if ($user->hasRole('mahasiswa')) {
            $bimbinganId = $user->mahasiswa?->bimbingan?->id;
            return $query->where('bimbingan_id', $bimbinganId);
        }

        if ($user->hasRole('dosen')) {
            $bimbinganIds = $user->dosen?->bimbingans->pluck('id');
            return $query->whereIn('bimbingan_id', $bimbinganIds);
        }
        return $query;
    }
    // --- BATAS FIX 1 ---

    // --- INI KODE YANG HILANG (FIX 2) ---
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\TextInput::make('judul_disetujui')
                    ->label('Judul Skripsi Anda')
                    ->disabled()
                    ->dehydrated(false)
                    ->default(function () {
                        $bimbingan = auth()->user()->mahasiswa?->bimbingan()
                                           ->where('status', 'aktif')
                                           ->first();
                        return $bimbingan?->judul_disetujui;
                    })
                    ->columnSpanFull(),
                
                Forms\Components\TextInput::make('topik')
                    ->label('Topik Bimbingan')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                
                Forms\Components\DateTimePicker::make('tanggal_diajukan')
                    ->label('Jadwal yang Diajukan')
                    ->native(false) 
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Hal yang ingin dibahas')
                    ->required()
                    ->columnSpanFull(),
                
                Forms\Components\DateTimePicker::make('tanggal_direvisi')
                    ->label('Jadwal Revisi (jika reschedule)')
                    ->native(false)
                    ->visible(fn ($record) => 
                        auth()->user()->hasRole('dosen') && $record?->status === 'reschedule'
                    ),
                Forms\Components\Textarea::make('alasan_penolakan')
                    ->label('Alasan Penolakan (jika ditolak)')
                    ->visible(fn ($record) => 
                        auth()->user()->hasRole('dosen') && $record?->status === 'rejected'
                    )
                    ->columnSpanFull(),
            ]);
    }
    // --- BATAS FIX 2 ---

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bimbingan.mahasiswa.nama_lengkap')
                    ->label('Mahasiswa')
                    ->searchable()
                    ->sortable()
                    ->visible(fn (): bool => !auth()->user()->hasRole('mahasiswa')),
                Tables\Columns\TextColumn::make('topik')->searchable(),
                Tables\Columns\TextColumn::make('tanggal_diajukan')->label('Jadwal Diajukan')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'reschedule' => 'info',
                    }),
                Tables\Columns\TextColumn::make('tanggal_direvisi')->label('Jadwal Baru')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('mode')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'online' => 'success',
                        'offline' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('tempat')
                    ->label('Tempat/Link')
                    ->limit(20)
                    ->tooltip(fn ($record) => $record->tempat),
            ])
            ->filters([
                //
            ])
            ->recordAction(null)
            ->recordUrl(null)
            ->actions([
                
                Tables\Actions\EditAction::make()
                    ->visible(fn (Model $record): bool => 
                        auth()->user()->hasRole('mahasiswa') && $record->status === 'pending'
                    ),
                
                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Model $record) => auth()->user()->hasRole('dosen') && $record->status === 'pending')
                    ->form([
                        Select::make('mode')
                            ->label('Mode Bimbingan')
                            ->options(['online' => 'Online', 'offline' => 'Offline'])
                            ->required(),
                        TextInput::make('tempat')
                            ->label('Tempat / Link')
                            ->placeholder(fn ($get) => $get('mode') === 'online' ? 'Contoh: https://meet.google.com/xxx' : 'Contoh: Ruang R.304')
                            ->required(),
                    ])
                    ->action(function (array $data, Model $record) {
                        
                        $dosenId = $record->bimbingan->dosen_id;
                        $proposedTime = $record->tanggal_diajukan; 

                        if (self::checkClash($dosenId, $proposedTime, $record->id)) {
                            Notification::make()
                                ->title('Jadwal Bentrok!')
                                ->body('Anda sudah memiliki jadwal bimbingan lain pada waktu tersebut.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $record->update([
                            'status' => 'approved',
                            'tanggal_balasan' => now(),
                            'mode' => $data['mode'],
                            'tempat' => $data['tempat'],
                        ]);
                        
                       Notification::make()
                            ->title('Jadwal Bimbingan Disetujui')
                            ->body("Dosen menyetujui jadwal di: {$data['tempat']} ({$data['mode']})")
                            ->success()
                            ->toDatabaseFormat() // <-- TAMBAHKAN INI
                            ->sendToDatabase($record->bimbingan->mahasiswa->user);
                        // --- BATAS PERBAIKAN ---
                    
                    }),
                
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Model $record) => auth()->user()->hasRole('dosen') && $record->status === 'pending')
                    ->form([
                        Textarea::make('alasan_penolakan')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (array $data, Model $record) {
                        $record->update([
                            'status' => 'rejected',
                            'tanggal_balasan' => now(),
                            'alasan_penolakan' => $data['alasan_penolakan'],
                        ]);

                        Notification::make()
                            ->title('Jadwal Bimbingan Ditolak')
                            ->body("Alasan: {$data['alasan_penolakan']}")
                            ->danger()
                            ->toDatabaseFormat() // <-- TAMBAHKAN INI
                            ->sendToDatabase($record->bimbingan->mahasiswa->user);
                        // --- BATAS PERBAIKAN ---
                    }),

                Tables\Actions\Action::make('reschedule')
                    ->label('Ubah Jadwal')
                    ->icon('heroicon-o-calendar-days')
                    ->color('info')
                    ->visible(fn (Model $record) => auth()->user()->hasRole('dosen') && $record->status === 'pending')
                    ->form([
                        DateTimePicker::make('tanggal_direvisi')
                            ->label('Jadwal Pengganti')
                            ->native(false)
                            ->required(),
                        Select::make('mode')
                            ->label('Mode Bimbingan')
                            ->options(['online' => 'Online', 'offline' => 'Offline'])
                            ->required(),
                        TextInput::make('tempat')
                            ->label('Tempat / Link')
                            ->placeholder(fn ($get) => $get('mode') === 'online' ? 'Contoh: https://meet.google.com/xxx' : 'Contoh: Ruang R.304')
                            ->required(),
                    ])
                    ->action(function (array $data, Model $record) {

                        $dosenId = $record->bimbingan->dosen_id;
                        $proposedTime = Carbon::parse($data['tanggal_direvisi']);

                        if (self::checkClash($dosenId, $proposedTime, $record->id)) {
                            Notification::make()
                                ->title('Jadwal Bentrok!')
                                ->body('Anda sudah memiliki jadwal bimbingan lain pada waktu tersebut.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $record->update([
                            'status' => 'reschedule',
                            'tanggal_balasan' => now(),
                            'tanggal_direvisi' => $data['tanggal_direvisi'],
                            'mode' => $data['mode'],
                            'tempat' => $data['tempat'],
                        ]);

                        Notification::make()
                            ->title('Jadwal Bimbingan Diubah')
                            ->body("Dosen mengubah jadwal ke: {$data['tanggal_direvisi']} di {$data['tempat']}")
                            ->info() // <-- Bagus untuk menambah warna
                            ->toDatabaseFormat() // <-- TAMBAHKAN INI
                            ->sendToDatabase($record->bimbingan->mahasiswa->user);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Kosong
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBimbinganRequests::route('/'),
            'create' => Pages\CreateBimbinganRequest::route('/create'),
            'edit' => Pages\EditBimbinganRequest::route('/{record}/edit'),
        ];
    }
}