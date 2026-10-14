<?php
// NAMA FILE: app/Filament/Resources/BimbinganResource/RelationManagers/BimbinganRequestsRelationManager.php

namespace App\Filament\Resources\BimbinganResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BimbinganRequestsRelationManager extends RelationManager
{
    protected static string $relationship = 'bimbinganRequests';
    protected static ?string $title = 'Riwayat Request Bimbingan';

    public function form(Form $form): Form
    {
        // Dibuat read-only, admin hanya melihat
        return $form->schema([]); 
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('topik')
            ->columns([
                Tables\Columns\TextColumn::make('topik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_diajukan')
                    ->label('Jadwal Diajukan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'reschedule' => 'info',
                    }),
                Tables\Columns\TextColumn::make('tanggal_direvisi')
                    ->label('Jadwal Baru')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction dinonaktifkan
            ])
            ->actions([
                // Arahkan ke halaman view utama BimbinganRequest
                Tables\Actions\ViewAction::make()
                    ->url(fn ($record) => \App\Filament\Resources\BimbinganRequestResource::getUrl('edit', ['record' => $record])),
                // Edit/Delete dinonaktifkan
            ])
            ->bulkActions([
                //
            ]);
    }
}