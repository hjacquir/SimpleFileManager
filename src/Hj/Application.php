<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

/**
 * Class Application
 * @package Hj
 *
 * @todo use Dependency Injection
 */
class Application implements HttpKernelInterface
{
    const CONTROLLER_ATTRIBUTE = '_controller';
    const PAGE_NOT_FOUND = 'Page not found';

    /**
     * Handles a Request to convert it to a Response.
     *
     * When $catch is true, the implementation must catch all exceptions
     * and do its best to convert them to a Response instance.
     *
     * @param Request $request A Request instance
     * @param int $type The type of the request
     *                         (one of HttpKernelInterface::MASTER_REQUEST or HttpKernelInterface::SUB_REQUEST)
     * @param bool $catch Whether to catch exceptions or not
     *
     * @return Response A Response instance
     *
     * @throws \Exception When an Exception occurs during processing
     *
     * @api
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        $routeLoader = new RouteLoader();

        $routes = $routeLoader->getRoutes();

        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($routes, $context);

        try {
            $pathInfo = $request->getPathInfo();

            $attributes = $matcher->match($pathInfo);
            $controller = $attributes[self::CONTROLLER_ATTRIBUTE];

            unset($attributes[self::CONTROLLER_ATTRIBUTE]);

            $response = call_user_func_array($controller, $attributes);
        } catch (ResourceNotFoundException $e) {
            $response = new Response(self::PAGE_NOT_FOUND, Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}