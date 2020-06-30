<label for="select1">所要時間：</label>
<div class="form-check form-check-inline">
    <input
        type="radio"
        class="form-check-input"
        name="after_minutes"
        value="{{ old('after_minutes') }}"
        id="after_minutes30"
        onClick="changeEndtime();" />
    <label class="form-check-label" for="after_minutes30">30分</label>
</div>
<div class="form-check form-check-inline">
    <input
        type="radio"
        class="form-check-input"
        name="after_minutes"
        value="{{ old('after_minutes') }}"
        id="after_minutes60"
        onClick="changeEndtime();" />
    <label class="form-check-label" for="after_minutes60">60分</label>
</div>
<div class="form-check form-check-inline">
    <input
        type="radio"
        class="form-check-input"
        name="after_minutes"
        value="{{ old('after_minutes') }}"
        id="after_minutes90"
        onClick="changeEndtime();" />
    <label class="form-check-label" for="after_minutes90">90分</label>
</div>
<div class="form-check form-check-inline">
    <input
        type="radio"
        class="form-check-input"
        name="after_minutes"
        value="{{ old('after_minutes') }}"
        id="after_minutes120"
        onClick="changeEndtime();" />
    <label class="form-check-label" for="after_minutes120">120分</label>
</div>