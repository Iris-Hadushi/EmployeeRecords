<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Department Information') }}
        </h2>
    </header>
        <div class="max-w-xl">
            <x-input-label for="department_name"/>
            <x-text-input id="department_name" name="department_name" type="text" class="mt-1 block w-full" :value="optional($user->department)->department_name" readonly />
            </div> 
</section>
