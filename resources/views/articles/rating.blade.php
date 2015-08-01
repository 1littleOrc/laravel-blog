<div class="br-wrapper br-theme-css-stars" @if (isset($ratingCount) && $ratingCount)itemscope itemprop="aggregateRating"
     itemtype="http://schema.org/AggregateRating"@endif>
    <div class="rating-message">
        <!-- Спасибо, рейтинг обновлен с учетом Вашего голоса. -->
        @if (isset($ratingCount) && $ratingCount)
            <span itemprop="ratingCount">{{ $ratingCount }}</span>
            {{ Lang::choice('оценка|оценки|оценок', $ratingCount) }}
        @endif
    </div>
    <select name="rating_{{ $id }}" class="rating">
        <option @if ($value == 0) selected @endif value="">-</option>
        @for ($v=1; $v<=5; $v++)
            <option @if ($value == $v) selected @if (isset($ratingCount) && $ratingCount) itemprop="ratingValue" @endif
                    @endif value="{{ $v }}">{{ $v }}
            </option>
        @endfor
    </select>
</div>