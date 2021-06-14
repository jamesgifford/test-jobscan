<table>
<thead>
    <tr>
        <th></th>
        <th>Skill</th>
        <th>Rating</th>
    </tr>
</thead>
<tbody>
@foreach ($skills as $skill)
    <tr>
        <td class="border-dashed border-t border-gray-200 px-3">
            <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                <input type="checkbox" class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline" :name="user.userId" @click="getRowDetail($event, user.userId)" name="1">
            </label>
        </td>
        <td class="border-dashed border-t border-gray-200 userId">
            <span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.userId">{{ $skill['name'] }}</span>
        </td>
        <td class="border-dashed border-t border-gray-200 firstName hidden">
            <span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.firstName">
                <select>
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="1">5</option>
                </select>
            </span>
        </td>
    </tr>
@endforeach
</tbody>
<table>
