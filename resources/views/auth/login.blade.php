<x-layout>
    <form action="/login" method="POST">
        @csrf

        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto ">
            <legend class="fieldset-legend">Log In</legend>

            <label class="label" for="email">Email</label>
            <input type="email" class="input" name="email" placeholder="Email" required/>
            
            <label class="label" for="password">Password</label>
            <input type="password" class="input" name="password" placeholder="Password" required/>
                <x-forms.error name="email" />
                <x-forms.error name="password" />
            <button class="btn btn-neutral mt-4">Log In</button>
        </fieldset>
    </form>
</x-layout>