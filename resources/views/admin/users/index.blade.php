<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <a class="btn btn-success" href="{{ route('admin.users.create') }}">Create New</a>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">username</th>
                            <th scope="col">phone</th>
                            <th scope="col">auth_link</th>
                            <th scope="col">link_expires_at</th>
                            <th scope="col">created_at</th>
                            <th scope="col">actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->auth_link }}</td>
                                    <td>{{ $user->link_expires_at }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>

                                        <form method="post" action="{{ route('admin.users.destroy', $user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-dark" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
