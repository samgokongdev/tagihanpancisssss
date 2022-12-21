<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VtunggakanResource\Pages;
use App\Filament\Resources\VtunggakanResource\RelationManagers;
use App\Models\Tunggakan;
use App\Models\Vtunggakan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
// use Filament\Tables\Filters\Layout;

class VtunggakanResource extends Resource
{
    protected static ?string $model = Vtunggakan::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'Tunggakan Pemeriksaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('np2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tgl_np2')
                    ->required(),
                Forms\Components\TextInput::make('up2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('npwp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_wp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kode_rik')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('periode_1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('periode_2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('masa_pajak')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tahun_pajak')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sp2')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tgl_sp2'),
                Forms\Components\DatePicker::make('tgl_sppl'),
                Forms\Components\TextInput::make('sphp')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tgl_sphp'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('np2')
                    ->label('NP2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_np2')
                    ->label('TANGGAL NP2')
                    ->date(),
                Tables\Columns\TextColumn::make('up2')
                    ->label('UP2'),
                Tables\Columns\TextColumn::make('npwp')
                    ->label('NPWP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_wp')
                    ->label('NAMA WP')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_rik')
                    ->label('KODE PEMERIKSAAN'),
                Tables\Columns\TextColumn::make('periode_1')
                    ->label('PERIODE 1'),
                Tables\Columns\TextColumn::make('periode_2')
                    ->label('PERIODE 2'),
                Tables\Columns\TextColumn::make('masa_pajak')
                    ->label('MASA PAJAK'),
                Tables\Columns\TextColumn::make('tahun_pajak')
                    ->label('TAHUN PAJAK'),

                Tables\Columns\TextColumn::make('sp2')
                    ->label('SP2'),
                Tables\Columns\TextColumn::make('tgl_sp2')
                    ->label('TANGGAL SP2')
                    ->date(),
                Tables\Columns\TextColumn::make('tgl_sppl')
                    ->label('TANGGAL SPPL')
                    ->date(),
                Tables\Columns\TextColumn::make('sphp')
                    ->label('SPHP'),
                Tables\Columns\TextColumn::make('tgl_sphp')
                    ->label('TANGGAL SPHP')
                    ->date(),
                Tables\Columns\TextColumn::make('tagihans.max_sp2')
                    ->label('TARGET TERBIT SP2')
                    ->date(),
                Tables\Columns\TextColumn::make('tagihans.max_permdok')
                    ->label('TARGET PERMINTAAN DOKUMEN')
                    ->date(),
                Tables\Columns\TextColumn::make('tagihans.max_pengujian1')
                    ->label('TARGET PENGUJIAN TAHAP 1')
                    ->date(),
                Tables\Columns\TextColumn::make('tagihans.max_pengujian2')
                    ->label('TARGET TERBIT SPHP')
                    ->date(),
                Tables\Columns\TextColumn::make('tagihans.max_lhp')
                    ->label('TARGET TERBIT LHP')
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('kode_rik')
                    ->multiple()
                    ->label('Kode Pemeriksaan')
                    ->options(
                        Vtunggakan::orderBy('kode_rik', 'asc')->pluck('kode_rik', 'kode_rik')
                    ),
                SelectFilter::make('is_sp2_terbit')
                    ->label('Apakah SP2 Sudah Terbit?')
                    ->options(
                        Vtunggakan::pluck('is_sp2_terbit_ref', 'is_sp2_terbit')
                    ),
                SelectFilter::make('is_sphp_terbit')
                    ->label('Apakah SPHP Sudah Terbit?')
                    ->options(
                        Vtunggakan::pluck('is_sphp_terbit_ref', 'is_sphp_terbit')
                    ),
                SelectFilter::make('bulan_max_sp2')
                    ->multiple()
                    ->label('Target SP2 (Bulan)')
                    ->options(
                        [
                            1 => 1,
                            2 => 2,
                            3 => 3,
                            4 => 4,
                            5 => 5,
                            6 => 6,
                            7 => 7,
                            8 => 8,
                            9 => 9,
                            10 => 10,
                            11 => 11,
                            12 => 12,
                        ]
                    ),
                SelectFilter::make('tahun_max_sp2')
                    ->label('Target SP2 (Tahun)')
                    ->options(
                        [
                            date('Y') => date('Y'),
                            date('Y') + 1 => date('Y') + 1,
                            date('Y') + 2 => date('Y') + 2
                        ]
                    ),
                SelectFilter::make('bulan_max_permdok')
                    ->multiple()
                    ->label('Target Permintaan Dokumen (Bulan)')
                    ->options(
                        [
                            1 => 1,
                            2 => 2,
                            3 => 3,
                            4 => 4,
                            5 => 5,
                            6 => 6,
                            7 => 7,
                            8 => 8,
                            9 => 9,
                            10 => 10,
                            11 => 11,
                            12 => 12,
                        ]
                    ),
                SelectFilter::make('tahun_max_permdok')
                    ->label('Target Permintaan Dokumen (Tahun)')
                    ->options(
                        [
                            date('Y') => date('Y'),
                            date('Y') + 1 => date('Y') + 1,
                            date('Y') + 2 => date('Y') + 2
                        ]
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TagihansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVtunggakans::route('/'),
            'create' => Pages\CreateVtunggakan::route('/create'),
            'edit' => Pages\EditVtunggakan::route('/{record}/edit'),
        ];
    }
}
