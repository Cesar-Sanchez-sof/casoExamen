<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Deuda;
use App\Models\Recordatorio;
use App\Http\Controllers\WhatsAppController;

class SendDebtReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Envía recordatorios de deudas 1 día antes del vencimiento.';

    public function handle()
    {
        $tomorrow = now()->addDay()->format('Y-m-d');

        $deudas = Deuda::with(['usuario', 'categoria'])
            ->whereDate('fecha_vencimiento', $tomorrow)
            ->where('estado_deuda', '!=', 'pagada')
            ->whereDoesntHave('recordatorios', function ($query) use ($tomorrow) {
                $query->whereDate('fecha_recordar', $tomorrow);
            })
            ->get();

        foreach ($deudas as $deuda) {
            $telefono = $deuda->usuario->telefono;
            $mensaje = $this->generateMessage($deuda);

            // Enviar WhatsApp
            $whatsapp = new WhatsAppController();
            $whatsapp->sendWhatsAppMessage($telefono, $mensaje);

            // Registrar recordatorio
            Recordatorio::create([
                'deuda_id' => $deuda->deuda_id,
                'fecha_recordar' => $tomorrow,
                'enviado' => true,
                'creado_en' => now(),
            ]);

            $this->info("Recordatorio enviado a {$deuda->usuario->nombre} (Deuda: {$deuda->titulo})");
        }
    }

    private function generateMessage(Deuda $deuda)
    {
        return sprintf(
            "Hola %s, recuerda que tu deuda *%s* por *S/%.2f* vence mañana (%s).\n\n" .
                "Categoría: %s\n" .
                "Descripción: %s",
            $deuda->usuario->nombre,
            $deuda->titulo,
            $deuda->monto,
            $deuda->fecha_vencimiento,
            $deuda->categoria->nombre ?? 'Sin categoría',
            $deuda->descripcion ?? 'Sin descripción'
        );
    }
}
