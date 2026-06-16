<x-layout>
    <x-form title="Register a new account" description="Store and track your ideas">
        <form action="{{ route('register') }}" method="post" class="mt-10 space-y-4">
            @csrf
            <x-form.field lable="Name" name="name" type="text" extra="required" />
            
            <x-form.field lable="email" name="email" type="email" extra="required" />
            
            <x-form.field lable="Password" name="password" type="password" extra="required" />
            
            <x-form.field lable="Confirm Password" name="password_confirmation" type="password" extra="required" />
            
            <button type="submit" class="btn w-full h-10">Create your new Account</button>
        </form>
    </x-form>
</x-layout>