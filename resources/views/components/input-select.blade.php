@props(['collection' => [], 'value', 'name', 'id'])

<select class="w-full rounded-lg my-3 bg-gray-100 text-dark px-3 py-2" name="{{$name}}" id="{{$id}}">
    <option value="{{$value}}">{{ucwords(str_replace('-', ' ', $value))}}</option>
    @foreach ($collection as $item)
        <option id="{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
    @endforeach
</select>