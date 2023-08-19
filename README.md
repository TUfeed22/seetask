# See Task - управление задачами
Приложение для рабыты с задачами, проектами.

## Формы
По умолчанию добавляя форму через FormType в шаблоне используется такой способ:

    {{ form_start(registrationForm) }}
        {{ form_row(registrationForm.email) }}
        {{ form_row(registrationForm.username) }}
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Сохранить</button>
    {{ form_end(registrationForm) }}

При рендеринге каждый элемент форма оборачивается в ```<div>```
Это может сломать верстку макета, если используется готовый. Чтобы этого избежать можно использовать такой способ:

    {{ form_start(registrationForm) }}

                <div class="form-group position-relative has-icon-left mb-4">
                    {{ form_widget(registrationForm.email) }}
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    {{ form_widget(registrationForm.username) }}
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    {{ form_widget(registrationForm.plainPassword) }}
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-check">
                    <div class="checkbox">
                        {{ form_widget(registrationForm.agreeTerms) }}
                        
                        <label for="checkbox1">Принять условия на обработку персональных данных.</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Регистрация</button>
            {{ form_end(registrationForm) }}

Здесь для вывода элемента формы, мы вместо ```form_row``` используем  ```form_widget```. Блягодаря этому мы можем аккуратно внедрить форму в готовый макет и не сломать верстку.
