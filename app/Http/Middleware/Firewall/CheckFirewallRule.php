<?php

namespace App\Http\Middleware\Firewall;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\FirewallRule;

class CheckFirewallRule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isLocalIp($request->source_ip)) {
            return response()->json(['errors' => true, 'message' => 'La direccion ip de origen no puede ser una IP local'], 412);
        }

        if ($this->existsRule($request->source_ip)) {
            return response()->json(['errors' => true, 'message' => 'Ya existe una regla que contiene esta direccion IP'], 412);
        }

        return $next($request);
    }

    protected function isLocalIp($ip)
    {
        // Expresión regular para IPs locales
        $localIpPatterns = [
            '/^127\./',            // IP local de loopback
            '/^0\./',              // IP reservada 0.0.0.0
            '/^169\.254\./',       // IP de autoconfiguración
            '/^10\./',             // Rango privado 10.0.0.0 - 10.255.255.255
            '/^172\.(1[6-9]|2[0-9]|3[0-1])\./', // Rango privado 172.16.0.0 - 172.31.255.255
            '/^192\.168\./'        // Rango privado 192.168.0.0 - 192.168.255.255
        ];

        foreach ($localIpPatterns as $pattern) {
            if (preg_match($pattern, $ip)) {
                return true;
            }
        }

        return false;
    }

    protected function existsRule($source_cidr)
    {
        $parts = explode('/', $source_cidr);
        $ip = $parts[0];

        $firewallRules = FirewallRule::get();

        foreach ($firewallRules as $rule) 
        {
            // Convert source_ip CIDR to start and end IP ranges
            list($cidrIp, $prefix) = explode('/', $rule->source_ip);

            $startIp = ip2long($cidrIp) & ~((1 << (32 - $prefix)) - 1);
            $endIp = $startIp + (1 << (32 - $prefix)) - 1;

            if (ip2long($ip) >= $startIp && ip2long($ip) <= $endIp) {
                // The IP is within the CIDR range

                return true;
            }
        }

        return false;
    }
}
