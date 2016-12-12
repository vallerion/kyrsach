<?php

namespace Framework\View\Twig;

use Countable;
use IteratorAggregate;
use Framework\View\Twig\Compiler;

/*
 * This file is part of Twig.
 *
 * (c) 2010 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Represents a node in the AST.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 3.0)
 */
interface NodeInterface extends Countable, IteratorAggregate
{
    /**
     * Compiles the node to PHP.
     */
    public function compile(Compiler $compiler);

    /**
     * @deprecated since 1.27 (to be removed in 2.0)
     */
    public function getLine();

    public function getNodeTag();
}
