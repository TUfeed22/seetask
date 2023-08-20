# See Task - управление задачами
Приложение для работы с задачами, проектами.

## Формы
По умолчанию добавляя форму через ```FormType``` в шаблоне используется такой способ:

    {{ form_start(form) }}
        {{ form_row(form.email) }}
        {{ form_row(form.username) }}
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Сохранить</button>
    {{ form_end(form) }}

При рендеринге, каждый элемент формы оборачивается в ```<div>```
Это может сломать верстку макета, если используется готовый. Чтобы этого избежать можно использовать такой способ:

    {{ form_start(form) }}

        <div class="form-group position-relative has-icon-left mb-4">
            {{ form_widget(form.email) }}
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
    
        <div class="form-group position-relative has-icon-left mb-4">
            {{ form_widget(form.username) }}
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Сохранить</button>
           
    {{ form_end(form) }}

Здесь для вывода элемента формы, мы вместо ```form_row()``` используем ```form_widget()```. Блягодаря этому мы можем аккуратно внедрить форму в готовый макет и не сломать верстку.


## Система ролей
Пока используется стандартная в symfony система ролей.
В БД роли хранятся массивом в колонке ```roles```.

Чтобы получить роль текущего пользователя:

    $user = $this->getUser();
    $roles = $user->getRoles();

В файле ```config/packages/security.yml``` можно настроить иерархию ролей:

    security:
        ....

        firewalls:
            ...
        
        role_hierarchy:
            ROLE_ADMIN: ROLE_USER
            ROLE_SUPER_ADMIN: [ROLE_ADMIN, ROLE_ALLOWED_TO_SWITCH]

Пользователи с ролью `ROLE_ADMIN` также будут иметь роль `ROLE_USER`. 
Пользователи с `ROLE_SUPER_ADMIN`, автоматически будут иметь `ROLE_ADMIN`, `ROLE_ALLOWED_TO_SWITCH` и `ROLE_USER` (унаследовано от `ROLE_ADMIN`).

Но чтобы иерархия работала, для проверки роли, лучше вместо `getRoles()` использовать `$this->isGranted('ROLE_ADMIN')`
