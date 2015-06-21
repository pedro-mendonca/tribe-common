<tr class="recurrence-row">
	<td><?php esc_html_e( 'Recurrence:', 'tribe-events-calendar-pro' ); ?></td>
	<td>
		<?php $has_recurrences = tribe_is_recurring_event( $postId ); ?>
		<input type="hidden" name="is_recurring" value="<?php echo ( isset( $recType ) && $recType != 'None' && $has_recurrences ) ? 'true' : 'false' ?>" />
		<select name="recurrence[type]" data-single="<?php esc_attr_e( 'event', 'tribe-events-calendar-pro' ) ?>" data-plural="<?php esc_attr_e( 'events', 'tribe-events-calendar-pro' ) ?>">
			<option value="None" <?php selected( $recType, 'None"') ?>><?php esc_html_e( 'None', 'tribe-events-calendar-pro' ); ?></option>
			<option value="Every Day" <?php selected( $recType, 'Every Day' ) ?>><?php esc_html_e( 'Every Day', 'tribe-events-calendar-pro' ); ?></option>
			<option value="Every Week" <?php selected( $recType, 'Every Week' ) ?>><?php esc_html_e( 'Every Week', 'tribe-events-calendar-pro' ); ?></option>
			<option value="Every Month" <?php selected( $recType, 'Every Month' ) ?>><?php esc_html_e( 'Every Month', 'tribe-events-calendar-pro' ); ?></option>
			<option value="Every Year" <?php selected( $recType, 'Every Year' ) ?>><?php esc_html_e( 'Every Year', 'tribe-events-calendar-pro' ); ?></option>
			<option value="Custom" <?php selected( $recType, 'Custom' ) ?>><?php esc_html_e( 'Custom', 'tribe-events-calendar-pro' ); ?></option>
		</select>
				<span id="recurrence-end" style="display: <?php echo ! $recType || $recType == 'None' ? 'none' : 'inline' ?>">
					<?php esc_html_e( 'and will end', 'tribe-events-calendar-pro' ); ?>
					<select name="recurrence[end-type]">
						<option value="On" <?php selected( $recEndType, 'None' ) ?>><?php esc_html_e( 'On', 'tribe-events-calendar-pro' ); ?></option>
						<option value="After" <?php selected( $recEndType, 'After' ) ?>><?php esc_html_e( 'After', 'tribe-events-calendar-pro' ); ?></option>
						<option value="Never" <?php selected( $recEndType, 'Never' ) ?>><?php esc_html_e( 'Never', 'tribe-events-calendar-pro' ); ?></option>
					</select>
					<input autocomplete="off" placeholder="<?php echo esc_attr( Tribe__Events__Date_Utils::date_only( date( Tribe__Events__Date_Utils::DBDATEFORMAT ) ) ); ?>" type="text" class="tribe-datepicker" name="recurrence[end]" id="recurrence_end" value="<?php echo esc_attr( $recEnd ); ?>" style="display:<?php echo ! $recEndType || $recEndType == "On" ? "inline" : "none"; ?>" />
					<span id="rec-count" style="display:<?php echo $recEndType == 'After' ? 'inline' : 'none'; ?>"><input autocomplete="off" type="text" name="recurrence[end-count]" id="recurrence_end_count" value="<?php echo esc_attr( $recEndCount ? $recEndCount : 1 ); ?>" style='width: 40px;' /> <span id='occurence-count-text'><?php _ex( 'events', 'occurence count text', 'tribe-events-calendar-pro' ) ?></span></span>
					<span id="rec-end-error" class="rec-error"><?php esc_html_e( 'You must select a recurrence end date', 'tribe-events-calendar-pro' ); ?></span>
				</span>
	</td>
</tr>
<tr class="recurrence-row" id="custom-recurrence-frequency" style="display: <?php echo $recType == 'Custom' ? 'table-row' : 'none' ?>;">
	<td></td>
	<td>
		<?php esc_html_e( 'Frequency', 'tribe-events-calendar-pro' ); ?>
		<select name="recurrence[custom-type]">
			<option value="Daily" data-plural="<?php esc_attr_e( 'Day(s)', 'tribe-events-calendar-pro' ); ?>" data-tablerow="" <?php selected( $recCustomType, "None" ) ?>><?php esc_html_e( 'Daily', 'tribe-events-calendar-pro' ); ?></option>
			<option value="Weekly" data-plural="<?php esc_attr_e( 'Week(s) on:', 'tribe-events-calendar-pro' ); ?>" data-tablerow="#custom-recurrence-weeks" <?php selected( $recCustomType, 'Weekly' ) ?>><?php esc_html_e( 'Weekly', 'tribe-events-calendar-pro' ); ?></option>
			<option value="Monthly" data-plural="<?php esc_attr_e( 'Month(s) on the:', 'tribe-events-calendar-pro' ); ?>" data-tablerow="#custom-recurrence-months" <?php selected( $recCustomType, 'Monthly' ) ?>><?php esc_html_e( 'Monthly', 'tribe-events-calendar-pro' ); ?></option>
			<option value="Yearly" data-plural="<?php esc_attr_e( 'Year(s) on:', 'tribe-events-calendar-pro' ); ?>" data-tablerow="#custom-recurrence-years" <?php selected( $recCustomType, 'Yearly' ) ?>><?php esc_html_e( 'Yearly', 'tribe-events-calendar-pro' ); ?></option>
		</select>
		<?php esc_html_e( 'Every', 'tribe-events-calendar-pro' ); ?>
		<input type="text" name="recurrence[custom-interval]" value="<?php echo esc_attr( $recCustomInterval ); ?>" />
		<span id="recurrence-interval-type"><?php echo esc_attr( $recCustomTypeText ); ?></span>
		<input type="hidden" name="recurrence[custom-type-text]" value="<?php esc_attr_e( $recCustomTypeText ) ?>" />
		<input type="hidden" name="recurrence[occurrence-count-text]" value="<?php esc_attr_e( _x( 'events', 'occurence count text', 'tribe-events-calendar-pro' ) ) ?>" />
		<span id="rec-days-error" class="rec-error"><?php esc_html_e( 'Frequency of recurring event must be a number', 'tribe-events-calendar-pro' ); ?></span>

	</td>
</tr>
<?php if ( ! isset( $recCustomWeekDay ) ) {
	$recCustomWeekDay = array();
} ?>
<tr class="custom-recurrence-row" id="custom-recurrence-weeks" style="display: <?php echo $recType == 'Custom' && $recCustomType == 'Weekly' ? 'table-row' : 'none' ?>;">
	<td></td>
	<td>
		<label><input type="checkbox" name="recurrence[custom-week-day][]" value="1" <?php checked( in_array( '1', $recCustomWeekDay ) ) ?>/> <?php esc_html_e( 'M', 'tribe-events-calendar-pro' ); ?>
		</label>
		<label><input type="checkbox" name="recurrence[custom-week-day][]" value="2" <?php checked( in_array( '2', $recCustomWeekDay ) ) ?>/> <?php esc_html_e( 'Tu', 'tribe-events-calendar-pro' ); ?>
		</label>
		<label><input type="checkbox" name="recurrence[custom-week-day][]" value="3" <?php checked( in_array( '3', $recCustomWeekDay ) ) ?>/> <?php esc_html_e( 'W', 'tribe-events-calendar-pro' ); ?>
		</label>
		<label><input type="checkbox" name="recurrence[custom-week-day][]" value="4" <?php checked( in_array( '4', $recCustomWeekDay ) ) ?>/> <?php esc_html_e( 'Th', 'tribe-events-calendar-pro' ); ?>
		</label>
		<label><input type="checkbox" name="recurrence[custom-week-day][]" value="5" <?php checked( in_array( '5', $recCustomWeekDay ) ) ?>/> <?php esc_html_e( 'F', 'tribe-events-calendar-pro' ); ?>
		</label>
		<label><input type="checkbox" name="recurrence[custom-week-day][]" value="6" <?php checked( in_array( '6', $recCustomWeekDay ) ) ?>/> <?php esc_html_e( 'Sa', 'tribe-events-calendar-pro' ); ?>
		</label>
		<label><input type="checkbox" name="recurrence[custom-week-day][]" value="7" <?php checked( in_array( '7', $recCustomWeekDay ) ) ?>/> <?php esc_html_e( 'Su', 'tribe-events-calendar-pro' ); ?>
		</label>
	</td>
</tr>
<tr class="custom-recurrence-row" id="custom-recurrence-months" style="display: <?php echo $recType == 'Custom' && $recCustomType == 'Monthly' ? 'table-row' : 'none' ?>;">
	<td></td>
	<td>
		<div id="recurrence-month-on-the">
			<select name="recurrence[custom-month-number]">
				<option value="First" <?php selected( $recCustomMonthNumber, $recCustomMonthNumber ? 'First' : '' ) ?>><?php esc_html_e( 'First', 'tribe-events-calendar-pro' ); ?></option>
				<option value="Second" <?php selected( $recCustomMonthNumber, 'Second' ) ?>><?php esc_html_e( 'Second', 'tribe-events-calendar-pro' ); ?></option>
				<option value="Third" <?php selected( $recCustomMonthNumber, 'Third' ) ?>><?php esc_html_e( 'Third', 'tribe-events-calendar-pro' ); ?></option>
				<option value="Fourth" <?php selected( $recCustomMonthNumber, 'Fourth' ) ?>><?php esc_html_e( 'Fourth', 'tribe-events-calendar-pro' ); ?></option>
				<option value="Fifth" <?php selected( $recCustomMonthNumber, 'Fifth' ) ?>><?php esc_html_e( 'Fifth', 'tribe-events-calendar-pro' ); ?></option>
				<option value="Last" <?php selected( $recCustomMonthNumber, 'Last' ) ?>><?php esc_html_e( 'Last', 'tribe-events-calendar-pro' ); ?></option>
				<option value="">--</option>
				<?php for ( $i = 1; $i <= 31; $i ++ ): ?>
					<option value="<?php echo $i ?>" <?php selected( $recCustomMonthNumber, $i ) ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
			<select name="recurrence[custom-month-day]" style="display: <?php echo is_numeric( $recCustomMonthNumber ) ? 'none' : 'inline' ?>">
				<option value="1"  <?php selected( $recCustomMonthDay, '1' ) ?>><?php esc_html_e( 'Monday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="2" <?php selected( $recCustomMonthDay, '2' ) ?>><?php esc_html_e( 'Tuesday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="3" <?php selected( $recCustomMonthDay, '3' ) ?>><?php esc_html_e( 'Wednesday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="4" <?php selected( $recCustomMonthDay, '4' ) ?>><?php esc_html_e( 'Thursday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="5" <?php selected( $recCustomMonthDay, '5' ) ?>><?php esc_html_e( 'Friday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="6" <?php selected( $recCustomMonthDay, '6' ) ?>><?php esc_html_e( 'Saturday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="7" <?php selected( $recCustomMonthDay, '7' ) ?>><?php esc_html_e( 'Sunday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="-" <?php selected( $recCustomMonthDay, '-' ) ?>>--</option>
				<option value="-1" <?php selected( $recCustomMonthDay, '-1' ) ?>><?php esc_html_e( 'Day', 'tribe-events-calendar-pro' ); ?></option>
			</select>
		</div>
	</td>
</tr>
<tr class="custom-recurrence-row" id="custom-recurrence-years" style="display: <?php echo $recCustomType == 'Yearly' ? 'table-row' : 'none' ?>;">
	<td></td>
	<td>
		<div>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="1" <?php checked( in_array( '1', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 1, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="2" <?php checked( in_array( '2', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 2, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="3" <?php checked( in_array( '3', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 3, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="4" <?php checked( in_array( '4', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 4, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="5" <?php checked( in_array( '5', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 5, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="6" <?php checked( in_array( '6', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 6, 1, 2020 ) ) ?>
			</label>
		</div>
		<div style="clear:both"></div>
		<div>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="7" <?php checked( in_array( '7', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 7, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="8" <?php checked( in_array( '8', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 8, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="9" <?php checked( in_array( '9', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 9, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="10" <?php checked( in_array( '10', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 10, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="11" <?php checked( in_array( '11', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 11, 1, 2020 ) ) ?>
			</label>
			<label><input type="checkbox" name="recurrence[custom-year-month][]" value="12" <?php checked( in_array( '12', $recCustomYearMonth ) ) ?>/> <?php echo date_i18n( 'M', mktime( 12, 0, 0, 12, 1, 2020 ) ) ?>
			</label>
		</div>
		<div style="clear:both"></div>
		<div>
			<input type="checkbox" name="recurrence[custom-year-filter]" value="1" <?php checked( $recCustomYearFilter, '1' ) ?>/>
			<?php _e( 'On the:', 'tribe-events-calendar-pro' ); ?>
			<select name="recurrence[custom-year-month-number]">
				<option value="1" <?php selected( $recCustomYearMonthNumber, '1' ) ?>><?php esc_html_e( 'First', 'tribe-events-calendar-pro' ); ?></option>
				<option value="2" <?php selected( $recCustomYearMonthNumber, '2' ) ?>><?php esc_html_e( 'Second', 'tribe-events-calendar-pro' ); ?></option>
				<option value="3" <?php selected( $recCustomYearMonthNumber, '3' ) ?>><?php esc_html_e( 'Third', 'tribe-events-calendar-pro' ); ?></option>
				<option value="4" <?php selected( $recCustomYearMonthNumber, '4' ) ?>><?php esc_html_e( 'Fourth', 'tribe-events-calendar-pro' ); ?></option>
				<option value="-1" <?php selected( $recCustomYearMonthNumber, '-1' ) ?>><?php esc_html_e( 'Last', 'tribe-events-calendar-pro' ); ?></option>
			</select>
			<select name="recurrence[custom-year-month-day]">
				<option value="1"  <?php selected( $recCustomYearMonthDay, '1' ) ?>><?php esc_html_e( 'Monday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="2" <?php selected( $recCustomYearMonthDay, '2' ) ?>><?php esc_html_e( 'Tuesday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="3" <?php selected( $recCustomYearMonthDay, '3' ) ?>><?php esc_html_e( 'Wednesday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="4" <?php selected( $recCustomYearMonthDay, '4' ) ?>><?php esc_html_e( 'Thursday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="5" <?php selected( $recCustomYearMonthDay, '5' ) ?>><?php esc_html_e( 'Friday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="6" <?php selected( $recCustomYearMonthDay, '6' ) ?>><?php esc_html_e( 'Saturday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="7" <?php selected( $recCustomYearMonthDay, '7' ) ?>><?php esc_html_e( 'Sunday', 'tribe-events-calendar-pro' ); ?></option>
				<option value="-" <?php selected( $recCustomYearMonthDay, '-' ) ?>>--</option>
				<option value="-1" <?php selected( $recCustomYearMonthDay, '-1' ) ?>><?php esc_html_e( 'Day', 'tribe-events-calendar-pro' ); ?></option>
			</select>
		</div>
	</td>
</tr>
<!-- TODO: please strip out the back end TS auto generated recurrence description and put it in the TS add-on
		<tr class="recurrence-pattern-description-row" id="recurrence_pattern_description_row">
		<td>
		<?php esc_html_e( 'Description:', 'tribe-events-calendar-pro' ); ?>
		</td>
		<td>
		<span id="recurrence-pattern-description"></span>
		</td>
		</tr>
		-->
<tr class="recurrence-pattern-description-row" id="custom-recurrence-text" style="display: <?php echo ! $recType || $recType == 'None' ? 'none' : 'table-row'; ?>;">
	<td style="vertical-align:top;"><?php esc_html_e( 'Recurrence Description:', 'tribe-events-calendar-pro' ); ?></td>
	<td>
		<input size="30" name="recurrence[recurrence-description]" type="text" value="<?php echo esc_attr( $recCustomRecurrenceDescription ) ?>" />
	</td>
</tr>
<tr class="recurrence-pattern-description-row" style="display: <?php echo ! $recType || $recType == 'None' ? 'none' : 'table-row'; ?>;">
	<td></td>
	<td>
		<p class="description"><?php esc_html_e( 'Create a custom plain language description of the recurrence. Leave it blank and we\'ll automate it.', 'tribe-events-calendar-pro' ); ?></p>
	</td>
</tr>
