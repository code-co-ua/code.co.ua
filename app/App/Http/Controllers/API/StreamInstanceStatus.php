<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Domain\Exercise\Instance;
use Domain\Exercise\InstanceStatusRepository;
use Illuminate\Http\Request;
use Support\Http\SSE;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamInstanceStatus extends Controller
{
    public function __invoke(
        Request $request,
        Instance $instance,
        SSE $sse,
        InstanceStatusRepository $statusRepository
    ): StreamedResponse {
        return response()->stream(fn() =>
            $statusRepository->listenForChanges(
                $instance,
                function ($message) use ($sse) {
                    $sse->sendEvent($message);
                }),
            200, [
                'Content-Type' => 'text/event-stream',
                'Cache-Control' => 'no-cache',
                'X-Accel-Buffering' => 'no',
            ]);
    }
}