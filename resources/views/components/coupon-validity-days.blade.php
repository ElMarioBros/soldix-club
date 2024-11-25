<div class="my-4 whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
    <p class="text-center font-light text-xl">Dias de Validez</p>
    <div class="grid grid-cols-7 mb-5">
        @php
            $days = [
                'Lun' => 'monday',
                'Mar' => 'tuesday',
                'Mie' => 'wednesday',
                'Jue' => 'thursday',
                'Vie' => 'friday',
                'Sáb' => 'saturday',
                'Dom' => 'sunday'
            ];
        @endphp

        @foreach($days as $label => $day)
            <label for="day{{ $loop->iteration }}" class="text-center select-none">{{ $label }}</label>
        @endforeach

        @foreach($days as $label => $day)
            <div class="inline-block m-auto">
                <input
                    id="day{{ $loop->iteration }}"
                    class="relative float-left mt-[0.15rem] p-4 rounded-[35%] border-[0.125rem] border-solid border-neutral-300 hover:cursor-pointer"
                    type="checkbox"
                    name="is_valid_{{ $day }}"
                    value="1"
                    @if(!$editable) disabled @endif
                    {{ !$coupon->{"is_valid_$day"} ?: 'checked' }}
                />
            </div>
        @endforeach
    </div>
</div>