
<!-- option-single-kanal -->
<div class="filter__chanel">
							
	<div class="sdrop">
		<div class="icon-select">
			<span class="icon-keyboard_arrow_down"></span>
		</div>
		<span class="sdrop__item-title">
			Kanal Detikcom
			<span class="sdrop__count"></span>
		</span>
		
	</div>
	
	<div class="sdrop__act options-single">
		<div class="sdrop__opt">
			
			<?php $bdrop = 2; ?>
			@foreach ($channels as $value => $title)
			<div class="sdrop__item">
				<label for="bdrop{{ $bdrop }}">
					<input id="bdrop{{ $bdrop }}" type="radio" class="sdrop__check" name="channels" value="{{ $value }}"> {{ $title }} 
				</label>
			</div>
			<?php $bdrop++; ?>
			@endforeach
			
		</div>
	</div>

</div>