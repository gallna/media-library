<?php
namespace Kemer\ContentDirectory;
/**
 * Visitor Pattern
 *
 * The contract for the visitor.
 *
 * Note 1 : in C++ or java, with method polymorphism based on type-hint, there are many
 * methods visit() with different type for the 'role' parameter.
 *
 * Note 2 : the visitor must not choose itself which method to
 * invoke, it is the Visitee that make this decision.
 */
interface ObjectVisitorInterface
{
    /**
     * Visit a Container object
     *
     * @param Kemer\ContentDirectory\ContainerInterface $container
     * @return bool true if container is accepted by visitor false otherwise
     */
    public function visitContainer(ContainerInterface $container);

    /**
     * Visit an Item object
     *
     * @param Kemer\ContentDirectory\ItemInterface $item
     * @return bool true if item is accepted by visitor false otherwise
     */
    public function visitItem(ItemInterface $item);
}
