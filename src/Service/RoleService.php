<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

class RoleService
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Возвращаем наименование ролей пользователя
     *
     * @param $roles array роли пользователя
     * @throws Exception
     */
    public function getRoleName(array $roles): string
    {
        $roleNames = $this->parseYaml('/config/role_name.yaml');

        $roleName = [];
        foreach ($roles as $role) {
            $roleName[] = $roleNames['role_name'][$role];
        }

        return implode(', ', $roleName);
    }

    /**
     * Парсинг yaml файлов
     *
     * @param $path string путь к файлу
     * @return array
     * @throws Exception
     */
    private function parseYaml(string $path): array
    {
        try {
            $yaml = file_get_contents($this->kernel->getProjectDir() . $path);
        } catch (Exception $e) {
            throw new Exception("Ошибка: " . $e->getMessage());
        }


        return Yaml::parse($yaml);
    }
}
