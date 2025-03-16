<?php

namespace App\Services;

class ThermalPrinterService
{
    /**
     * Membuat teks untuk printer thermal
     */
    public function createText(array $lines)
    {
        $text = [
            $this->initializePrinter(),
        ];

        foreach ($lines as $line) {
            $text[] = $this->formatLine($line);
        }

        $text[] = $this->feedPaper();
        $text[] = $this->cutPaper();

        return implode('', $text);
    }

    private function formatLine(array $line)
    {
        $formattedLine = '';

        if (isset($line['align'])) {
            $formattedLine .= $this->align($line['align']);
        }

        if (isset($line['style'])) {
            $formattedLine .= $this->style($line['style']);
        }

        $formattedLine .= $line['text'] . "\n";

        if (isset($line['style'])) {
            $formattedLine .= $this->resetStyle();
        }

        return $formattedLine;
    }

    private function initializePrinter()
    {
        return "\x1B\x40";  // Initialize printer
    }

    private function align($alignment)
    {
        switch ($alignment) {
            case 'center':
                return "\x1B\x61\x01";  // Center alignment
            case 'right':
                return "\x1B\x61\x02";  // Right alignment
            default:
                return "\x1B\x61\x00";  // Left alignment
        }
    }

    private function style($style)
    {
        switch ($style) {
            case 'double':
                return "\x1B\x21\x30";  // Double-height, double-width
            default:
                return "\x1B\x21\x00";  // Normal text
        }
    }

    private function resetStyle()
    {
        return "\x1B\x21\x00";  // Reset to normal text
    }

    private function feedPaper()
    {
        return "\n\n\n";  // Feed paper
    }

    private function cutPaper()
    {
        return "\x1B\x69";  // Cut paper
    }

}
