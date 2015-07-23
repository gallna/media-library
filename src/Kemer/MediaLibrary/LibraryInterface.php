<?php
namespace Kemer\MediaLibrary;

interface LibraryInterface
{
    /**
     * Return object by given id
     *
     * @param string $id
     * @return ObjectInterface
     */
    public function get($id);

    /**
     * Return all library items
     *
     * @return []ItemInterface
     */
    public function getItems();

    /**
     * Add item into library
     *
     * @param ItemInterface $item
     * @return LibraryInterface
     */
    public function addItem(ItemInterface $item);

    /**
     * Return all library containers
     *
     * @return []ContainerInterface
     */
    public function getContainers();

    /**
     * Return all library containers
     *
     * @param ContainerInterface $container
     * @return LibraryInterface
     */
    public function addContainer(ContainerInterface $container);
}
