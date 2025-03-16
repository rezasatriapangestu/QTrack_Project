<?php

namespace App\Filament\Pages;

use App\Models\Service;
use App\Services\ThermalPrinterService;
use Filament\Pages\Page;

class QueueKiosk extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static string $view = 'filament.pages.queue-kiosk';

    protected static string $layout = 'filament.layouts.base-kiosk';

    public function getViewData(): array
    {
        return [
            'services' => Service::where('is_active', true)->get(),
        ];
    }

    public function print($serviceId)
    {
        $printerService = app(ThermalPrinterService::class);

        $text = $printerService->createText([
            ['text' => 'Puskemas Example', 'align' => 'center'],
            ['text' => 'Jalan Coba No. 123', 'align' => 'center'],
            ['text' => '-----------------', 'align' => 'center'],
            ['text' => 'NOMOR ANTRIAN', 'align' => 'center'],
            ['text' => $newQueue->number, 'align' => 'center', 'style' => 'double'],
            ['text' => $newQueue->created_at->format('d-m-Y H:i'), 'align' => 'center'],
            ['text' => '-----------------', 'align' => 'center'],
            ['text' => 'Mohon menunggu', 'align' => 'center']
        ]);

        $this->dispatch("print-start", $text);
    }
}

