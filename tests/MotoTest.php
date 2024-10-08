<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\MotoTipoEnum;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MotoTest extends ApiTestCase
{
    private const CODIGO_HTTP_CREATE = 201;
    private const CODIGO_HTTP_UPDATE = 200;
    private const CODIGO_HTTP_DELETE = 204;
    private const CODIGO_HTTP_ERROR = 404;

    /**
     * Test para el método GET del CRUD
     *
     * @return void
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testMotosGet(): void
    {
        // Petición GET lista de motos (la colección)
        static::createClient()->request('GET', 'api/motos');

        // Si va todo bien, la respuesta debe ser existosa
        $this->assertResponseIsSuccessful();

        // Si la estructura es correcta
        $this->assertJsonContains([]);
    }

    /**
     * Test para el método POST del CRUD
     *
     * @return void
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testMotoPost(): void
    {
        // Petición POST para crear una moto
        static::createClient()->request('POST', 'api/motos', [
            'headers' => ['Content-Type' => 'application/ld+json'],
            'json' => [
                'modelo' => 'Honda Rebel 1100',
                'cilindrada' => 1100,
                'marca' => 'Honda',
                'tipo' => MotoTipoEnum::TIPO_MOTO_CUSTOM,
                'extras' => ['asiento confort', 'cúpula'],
                'edicionLimitada' => true
            ]
        ]);

        // La respuesta correta es el código HTTP 201
        $this->assertResponseStatusCodeSame(self::CODIGO_HTTP_CREATE);

        $this->assertJsonContains(['cilindrada' => 1100]);
    }

    /**
     * Test para el método PUT del CRUD
     *
     * Es necesario crear una moto para despues updatearla
     *
     * @return void
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testMotoPut(): void
    {
        // Petición POST para crear una moto
        static::createClient()->request('POST', 'api/motos', [
            'headers' => ['Content-Type' => 'application/ld+json'],
            'json' => [
                'modelo' => 'Honda Rebel 1100',
                'cilindrada' => 1100,
                'marca' => 'Honda',
                'tipo' => MotoTipoEnum::TIPO_MOTO_CUSTOM,
                'extras' => ['asiento confort', 'cúpula'],
                'edicionLimitada' => true
            ]
        ]);

        // Petición PUT para crear una moto
        static::createClient()->request('PATCH', 'api/motos/19', [
            'headers' => ['Content-Type' => 'application/merge-patch+json'],
            'json' => [
                'modelo' => 'Honda Rebel 500',
                'cilindrada' => 500,
                'marca' => 'Honda',
                'tipo' => MotoTipoEnum::TIPO_MOTO_CUSTOM,
                'extras' => ['asiento confort', 'cúpula'],
                'edicionLimitada' => true
            ]
        ]);

        // La respuesta correcta es el código HTTP 200
        $this->assertResponseStatusCodeSame(self::CODIGO_HTTP_UPDATE);

        // Si ha cambiado la cilindrada quiere decir que sí se ha actualizado
        $this->assertJsonContains(['cilindrada' => 500]);
    }

    /**
     * @return void
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testMotoDelete(): void
    {
        // Petición POST para crear una moto
        static::createClient()->request('POST', 'api/motos', [
            'headers' => ['Content-Type' => 'application/ld+json'],
            'json' => [
                'modelo' => 'Honda Rebel 1100',
                'cilindrada' => 1100,
                'marca' => 'Honda',
                'tipo' => MotoTipoEnum::TIPO_MOTO_CUSTOM,
                'extras' => ['asiento confort', 'cúpula'],
                'edicionLimitada' => true
            ]
        ]);

        // Después se borra la moto
        static::createClient()->request('DELETE', 'api/motos/19');

        // La respuesta correta es el código HTTP 204
        $this->assertResponseStatusCodeSame(self::CODIGO_HTTP_DELETE);

        // Se obtiene la moto, y si se ha borrado debería devolver un 404 porque no existe
        static::createClient()->request('GET', 'api/motos/19');
        $this->assertResponseStatusCodeSame(self::CODIGO_HTTP_ERROR);
    }
}