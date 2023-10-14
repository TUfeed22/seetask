<?php

namespace App\Repository;

use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

trait EntityRepository
{
    /**
     * Подготовка задач по создателю
     * @param User $user
     */
    public function preparingObjectsByCreator(User $user): void
    {
        $this->allTasks = $this->findBy(['creator' => $user]);
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
            $this->allTasks,
            $startNumPage,
            $limit,
            $params
        );
    }
}
