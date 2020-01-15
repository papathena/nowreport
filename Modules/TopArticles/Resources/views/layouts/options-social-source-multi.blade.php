<!-- options socialsource multi -->
<div class="filter__chanel">
							
	<div class="rdrop">
		<div class="icon-select">
			<span class="icon-keyboard_arrow_down"></span>
		</div>
		<span class="rdrop__item-title">
			Inbound Marketing
			<span class="rdrop__count"></span>
		</span>
		
	</div>
	
	<div class="rdrop__act options-multi">
		
		<div class="rdrop__opt ">
			
			<?php $rdrop = 2; ?>
			@foreach($inmarketName as $inmarket)
			<div class="rdrop__item">
				<label for="rdrop{{ $rdrop }}">
					<input id="rdrop{{ $rdrop }}" type="checkbox" class="rdrop__check" name="inmarket[]" value="{{ $inmarket }}"> {{ ucfirst($inmarket) }}
					<span class="checkmark">
						<span class="icon-check_circle"></span>
					</span>
				</label>
			</div>
			<?php $rdrop++; ?>
			@endforeach
			<div class="rdrop__item mt30">
				<input type="button" class="btn btn-long btn-info apply-inmarket" value="APPLY">
			</div>
		</div>
	</div>
</div>
<div class="preview-pop" data-touch="popup">
	?
</div>