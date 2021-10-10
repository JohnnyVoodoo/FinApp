@props(['name' => 'time'])
<div {!! $attributes->merge(['class' => 'antialiased sans-serif']) !!}>
    <x-label for="{{$name}}" value="{{__('Select Time')}}"/>
    <select name="{{$name}}" id="{{$name}}"
            class="mt-2 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
        <option value="00:00:00">00:00</option>
        <option value="01:00:00">01:00</option>
        <option value="02:00:00">02:00</option>
        <option value="03:00:00">03:00</option>
        <option value="04:00:00">04:00</option>
        <option value="05:00:00">05:00</option>
        <option value="06:00:00">06:00</option>
        <option value="07:00:00">07:00</option>
        <option value="08:00:00">08:00</option>
        <option value="09:00:00">09:00</option>
        <option value="10:00:00">10:00</option>
        <option value="11:00:00">11:00</option>
        <option value="12:00:00">12:00</option>
        <option value="13:00:00">13:00</option>
        <option value="14:00:00">14:00</option>
        <option value="15:00:00">15:00</option>
        <option value="16:00:00">16:00</option>
        <option value="17:00:00">17:00</option>
        <option value="18:00:00">18:00</option>
        <option value="19:00:00">19:00</option>
        <option value="20:00:00">20:00</option>
        <option value="21:00:00">21:00</option>
        <option value="22:00:00">22:00</option>
        <option value="23:00:00">23:00</option>
    </select>
</div>
