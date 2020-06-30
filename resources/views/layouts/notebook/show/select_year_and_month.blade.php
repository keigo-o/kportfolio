<select class="custom-select col-sm-2 col-lg-2" name="year" id="year">
@for($i = $pastShowYear; $i <= $futureShowYear; $i++)
  <option value="{{$i}}" @if($i == $selectYear) selected @elseif(null == $selectYear && $i == $nen) selected @endif>{{$i}}</option>
@endfor
</select>年
<select class="custom-select col-sm-2 col-lg-2" name="month" id="month">
    <option value="" @empty($selectMonth) selected @endempty>全</option>
    @for($i = 0; $i < 12; $i++)
    <option value="{{ $showMonth[$i] }}" @if($showMonth[$i] == $selectMonth) selected @elseif(null == $selectMonth && $showMonth[$i] == $tuki) selected @endif>{{ $optionMonth[$i] }}</option>
    @endfor
</select>月