
<!-- option-multi-kanal -->
<div class="filter__chanel">
							
	<div class="rdrop">
		<div class="icon-select">
			<span class="icon-keyboard_arrow_down"></span>
		</div>
		<span class="rdrop__item-title">
			Kanal Detikcom
			<span class="rdrop__count"></span>
		</span>
		
	</div>
	
	<div class="rdrop__act options-multi">
		<div class="rdrop__opt">
			<div class="rdrop__title">
				Max selected is 5
			</div>
			<?php $rdrop = 1; ?>
			@foreach ($channels as $value => $title)
				<div class="rdrop__item">
					<label for="rdrop{{ $rdrop }}">
						<input id="rdrop{{ $rdrop }}" type="checkbox" class="rdrop__check" name="channels[]" value="{{ $value }}"> {{ $title }}
						<span class="checkmark">
							<span class="icon-check_circle"></span>
						</span>
					</label>
				</div>
				<?php $rdrop++; ?>
			@endforeach
			<div class="rdrop__item mt30">
				<input type="button" class="btn btn-long btn-info apply-channels" value="APPLY">
			</div>
		</div>
	</div>

</div>