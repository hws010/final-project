@props(['error' => 'error'])
<x-layout>
    <x-form title="Login" description="Login to your Account">
        <form action="#" method="post" class="mt-10 space-y-4">
            @csrf
            <x-form.field lable="Email" name="email" type="email" extra="required" />
            
            <x-form.field lable="Password" name="password" type="password" extra="required" />
            
            <button type="submit" class="btn w-full h-10">Create your new Account</button>
        </form>
    </x-form>
</x-layout>