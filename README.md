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
