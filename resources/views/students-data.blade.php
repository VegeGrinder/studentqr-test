@forelse ($rows as $row)
    <tr class="text-center">
        <td>{{ $row[0] }}</td>
        <td>{{ $row[1] }}</td>
        <td>{{ $row[2] }}</td>
        <td>{{ $row[3] }}</td>
    </tr>
@empty
    <td colspan="4" class="text-center">No data</td>
@endforelse
