@extends('admin.layouts.app')

@section('title', 'Пользователи')

@section('content')
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>email</th>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                    <th>Создан</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <strong>{{ $user->email }}</strong>
                        </td>
                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>
                        <td>
                            <select class="change-role" data-id="{{ $user->id }}">
                                <option value="user" {{ $user->role->value === 'user' ? 'selected' : '' }}>Пользователь</option>
                                <option value="admin" {{ $user->role->value === 'admin' ? 'selected' : '' }}>Админ</option>
                            </select>
                        </td>
                        <td>
                            <span>{{ $user->created_at->format('d.m.Y') }}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            {{ $users->onEachSide(1) -> links('pagination.custom') }}
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.change-role').forEach(select => {
                    select.addEventListener('change', async (e)=> {
                        const userId = e.target.dataset.id;
                        const newRole = e.target.value;

                        try {
                            const response = await fetch(`/admin/users/${userId}/role`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'

                                },
                                body: JSON.stringify({ role: newRole })
                            });

                            if (!response.ok) {
                                throw new Error('Ошибка при обновлении роли')
                            }

                            const json = await response.json()
                            console.log(json.message)
                        } catch(error) {
                            alert('Не удалось обновить роль')
                            console.error(error)
                        }
                    })
                })
            })
        </script>
@endsection
