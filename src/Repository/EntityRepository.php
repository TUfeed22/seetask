<?php

namespace App\Repository;

use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

trait EntityRepository
{
    /**
     * Подготовка списка сущностей по создателю
     * @param User $user
     */
    public function preparingObjectsByCreator(User $user): void
    {
        $this->allEntities = $this->findBy(['creator' => $user]);
    }

    /**
     * Вывод результатов с возможностью пагинации
     *
     * @param PaginatorInterface $paginator интерфейс пагинации
     * @param $startNumPage - с какой страницы начать пагинацию
     * @param int $limit - кол-во записей на странице
     * @param string[] $params параметры отображения по умолчанию
     * @return PaginationInterface
     */
    public function pagination(PaginatorInterface $paginator, $startNumPage, int $limit = 5, array $params = [
        'defaultSortFieldName' => 'id',
        'defaultSortDirection' => 'desc',
    ]): PaginationInterface
    {
        return $paginator->paginate(
            $this->allEntities,
            $startNumPage,
            $limit,
            $params
        );
    }

    /**
     * Возвращает массив пригодный для формирования select для формы
     *
     * @return array
     */
    public function getOptionsToSelect(): array
    {
        $options = [
            'options' => [
                'Выбрать' => null // если не нужен
            ],
        ];

        foreach ($this->allEntities as $entity) {
            $options['options']['#' . $entity->getId() . ' ' . $entity->getName()] = $entity;
        }
        return $options;
    }
}
