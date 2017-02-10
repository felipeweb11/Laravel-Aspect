<?php

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 *
 * Copyright (c) 2015-2016 Yuuki Takezawa
 *
 */
namespace Ytake\LaravelAspect\PointCut;

use Ray\Aop\Matcher;
use Ray\Aop\Pointcut;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Container\Container;
use Ytake\LaravelAspect\Annotation\ExceptionHandler;

/**
 * Class ExceptionHandlerPointCut
 */
class ExceptionHandlerPointCut extends CommonPointCut implements PointCutable
{
    /** @var  string */
    protected $annotation = ExceptionHandler::class;

    /**
     * {@inheritdoc}
     */
    public function configure(Container $app)
    {
        if (method_exists($this->interceptor, 'setAnnotation')) {
            $this->interceptor->setAnnotation($this->annotation);
        }
        return new Pointcut(
            (new Matcher)->subclassesOf(Controller::class),
            (new Matcher)->any(),
            [$this->interceptor]
        );
    }
}
