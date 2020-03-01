<?php declare(strict_types=1);

namespace Support\Http;

/**
 * Server-Sent events
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Server-sent_events
 */
final class SSE
{
    public function sendEvent(
        string $data,
        string $event = null,
        string $id = null,
        string $retry = null
    ): void {
        $response = $event ? "event: $event\n" : '';
        $response .= "data: $data\n\n";
        $response .= $id ? "id: $id\n" : '';
        $response .= $retry ? "retry: $retry\n" : '';
        echo $response;
        ob_flush();
        flush();
    }
}