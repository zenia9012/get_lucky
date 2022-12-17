<x-app-layout>

    <div class="py-12">
        <div class="container">
            <div class="row">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-md-6">
                    <form action="{{ route('admin.users.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">phone</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="hidden" name="is_admin" value="0">
                            <input type="checkbox" class="form-check-input" value="1" name="is_admin">
                            <label class="form-check-label">Is Admin</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
