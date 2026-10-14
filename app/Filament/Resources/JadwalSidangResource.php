<?php
// NAMA FILE: app/Filament/Resources/JadwalSidangResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalSidangResource\Pages;
use App\Models\JadwalSidang;
use App\Models\Bimbingan; // <-- TAMBAHKAN
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification; 
use Illuminate\Database\Eloquent\Builder;// <-- TAMBAHKAN

class JadwalSidangResource extends Resource
{
    protected static ?string $model = JadwalSidang::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Manajemen Skripsi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bimbingan_id')
                    ->label('Mahasiswa Bimbingan')
                    // Ambil bimbingan yang masih 'aktif' DAN belum punya jadwal sidang
                    ->options(
                        Bimbingan::where('status', 'aktif')
                                 ->doesntHave('jadwalSidang')
                                 ->with('mahasiswa') // Ambil data mahasiswa
                                 ->get()
                                 ->pluck('mahasiswa.nama_lengkap', 'id') 
                    )
                    ->searchable()
                    ->required(),
                Forms\Components\DateTimePicker::make('tanggal_sidang')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('tempat')
                    ->label('Tempat / Link Online')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bimbingan.mahasiswa.nama_lengkap')->label('Mahasiswa'),
                Tables\Columns\TextColumn::make('bimbingan.dosen.nama_lengkap')->label('Pembimbing'),
                Tables\Columns\TextColumn::make('bimbingan.penguji.nama_lengkap')->label('Penguji'),
                Tables\Columns\TextColumn::make('tanggal_sidang')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('status_sidang')->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                // --- INI ADALAH TOMBOL UNTUK OTOMATISASI ---
                Tables\Actions\Action::make('prosesHasilSidang')
                    ->label('Input Hasil Sidang')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    // Hanya muncul jika statusnya masih 'dijadwalkan'
                    ->visible(fn (Model $record) => $record->status_sidang === 'dijadwalkan')
                    ->form([
                        Forms\Components\Select::make('status_sidang')
                            ->label('Hasil Sidang')
                            ->options([
                                'lulus' => 'Lulus',
                                'lulus_revisi' => 'Lulus (Perlu Revisi)',
                                'gagal' => 'Gagal',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('catatan_hasil_sidang')
                            ->label('Catatan Revisi / Alasan Gagal'),
                    ])
                    ->action(function (array $data, Model $record) {
                        // 1. Update Jadwal Sidang ini
                        $record->update([
                            'status_sidang' => $data['status_sidang'],
                            'catatan_hasil_sidang' => $data['catatan_hasil_sidang'],
                        ]);

                        // 2. OTOMATISASI: Jika Lulus, update Bimbingan
                        if ($data['status_sidang'] === 'lulus' || $data['status_sidang'] === 'lulus_revisi') {
                            $bimbingan = $record->bimbingan;
                            $bimbingan->update(['status' => 'selesai']);
                        }
                        
                        // 3. Kirim Notifikasi
                        Notification::make()
                            ->title('Hasil Sidang Telah Keluar!')
                            ->body("Status sidang Anda: " . strtoupper($data['status_sidang']))
                            ->success()
                            ->toDatabaseFormat() // <-- TAMBAKAN INI
                            ->sendToDatabase($record->bimbingan->mahasiswa->user);
                    }),
            ])
            ->bulkActions([
                // ...
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalSidangs::route('/'),
            'create' => Pages\CreateJadwalSidang::route('/create'),
            'edit' => Pages\EditJadwalSidang::route('/{record}/edit'),
        ];
    }  
    
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        // Jika yang login Mahasiswa
        if ($user->hasRole('mahasiswa')) {
            // Ambil ID bimbingan mahasiswa tersebut
            $bimbinganId = $user->mahasiswa?->bimbingan?->id;

            // Hanya tampilkan jadwal sidang yang bimbingan_id nya cocok
            return $query->where('bimbingan_id', $bimbinganId);
        }

        // Jika Dosen atau Admin, tampilkan semua (atau filter sesuai kebutuhan Dosen)
        // Anda bisa tambahkan filter untuk Dosen di sini jika perlu
        // if ($user->hasRole('dosen')) { ... }

        return $query; // Admin bisa lihat semua
    }
}