<?php

namespace App\Http\Middleware;

use Closure;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

use Lcobucci\JWT\Parser;

class ValidateJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Configuração inicial para verificação de assinatura
        $jwt_signer = new Sha256;
        $jwt_secret = "ThisIsASecret";

        // Pegando o token do header Authorization: bearer <token...>
        $bearer_token = $request->header('Authorization');

        // isolando o token em uma variavel
        // token[0] = bearer
        // token[1] = <token...>
        $token = explode(" ", $bearer_token);

        // Tratando a string do token tirando todos espaços em branco
        $jwt_token = trim($token[1], ' ');
        echo($jwt_token);

        // Transformando a string em uma nova estancia do jwt
        $jwt_token = (new Parser())->parse((string) $jwt_token);

        // Efetuando testes
        echo("<br><h3>Token Header</h3><h4>".json_encode($jwt_token->getHeaders())."</h4>");
        echo("<br><h3>Token Claims</h3><h4>".json_encode($jwt_token->getClaims())."</h4>");
        // Verificação de assinatura
        echo("<br><h3>Token Verify (Correct Key)</h3><h4>".json_encode($jwt_token->verify($jwt_signer, $jwt_secret))."</h4>");
        echo("<br><h3>Token Verify (Wrong Key)</h3><h4>".json_encode($jwt_token->verify($jwt_signer, '123456'))."</h4>");

        return $next($request);
    }
}
