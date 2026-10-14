<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BimbinganResource\Pages;
// Hapus RelationManagers
use App\Models\Bimbingan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder; // Pastikan ini ada
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BimbinganResource\RelationManagers;


class BimbinganResource extends Resource
{
    protected static ?string $model = Bimbingan::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    // FUNGSI UNTUK MENGELOMPOKKAN MENU
    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Skripsi';
    }

    // FUNGSI UNTUK MENAMPILKAN MENU SESUAI ROLE
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'dosen', 'mahasiswa']);
    }

    // FUNGSI UNTUK MEMFILTER DATA SESUAI ROLE (PERBAIKAN POIN 2a & 2b)
   public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        if ($user->hasRole('mahasiswa')) {
            // Mahasiswa hanya lihat 1 bimbingan miliknya
            return $query->where('mahasiswa_id', $user->mahasiswa?->id);
        }

        if ($user->hasRole('dosen')) {
            // --- INI PERUBAHANNYA ---
            $dosenId = $user->dosen?->id;

            // Dosen melihat bimbingan jika dia adalah Pembimbing ATAU Penguji
            return $query->where(function (Builder $q) use ($dosenId) {
                $q->where('dosen_id', $dosenId)      // Dia adalah Pembimbing
                  ->orWhere('penguji_id', $dosenId); // ATAU dia adalah Penguji
            });
            // --- BATAS PERUBAHAN ---
        }

        // Admin bisa lihat semua
        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mahasiswa_id')
                    ->relationship('mahasiswa', 'nama_lengkap')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('dosen_id')
                    ->relationship('dosen', 'nama_lengkap')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('pengajuan_judul_id')
                    ->relationship('pengajuanJudul', 'judul_1') 
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('judul_disetujui')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'selesai' => 'Selesai',
                        'drop_out' => 'Drop Out',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nama_lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dosen.nama_lengkap')
                    ->label('Pembimbing') // Label dipersingkat
                    ->searchable()
                    ->sortable()
                    ->visible(fn (): bool => !auth()->user()->hasRole('dosen')),
                
                // --- TAMBAHAN BARU ---
                Tables\Columns\TextColumn::make('penguji.nama_lengkap')
                    ->label('Penguji')
                    ->searchable()
                    ->sortable()
                    ->visible(fn (): bool => auth()->user()->hasRole('admin')), // Misal, hanya admin
                // --- BATAS TAMBAHAN ---

                Tables\Columns\TextColumn::make('judul_disetujui')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->judul_disetujui),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif' => 'primary',
                        'selesai' => 'success',
                        'drop_out' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Utama')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('mahasiswa.nama_lengkap')->label('Mahasiswa'),
                        TextEntry::make('mahasiswa.nim')->label('NIM'),
                        
                        // --- INI PERUBAHANNYA ---
                        TextEntry::make('dosen.nama_lengkap')->label('Dosen Pembimbing'),
                        TextEntry::make('dosen.nidn')->label('NIDN Pembimbing'),

                        TextEntry::make('penguji.nama_lengkap')->label('Dosen Penguji'),
                        TextEntry::make('penguji.nidn')->label('NIDN Penguji'),
                        // --- BATAS PERUBAHAN ---
                    ]),
                Section::make('Detail Skripsi')
                    ->schema([
                        TextEntry::make('judul_disetujui')->label('Judul Skripsi'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'aktif' => 'primary',
                                'selesai' => 'success',
                                'drop_out' => 'danger',
                            }),
                        TextEntry::make('created_at')->dateTime()->label('Tanggal Mulai'),
                    ]),
            ]);
    }

    // KEMBALIKAN getRelations() MENJADI KOSONG
    public static function getRelations(): array
    {
        return [
            RelationManagers\BimbinganRequestsRelationManager::class,
        ];
    }

    // KEMBALIKAN getPages() KE VERSI ASLI
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBimbingans::route('/'),
            'create' => Pages\CreateBimbingan::route('/create'),
            // Hapus 'view'
            'edit' => Pages\EditBimbingan::route('/{record}/edit'),
        ];
    }
}