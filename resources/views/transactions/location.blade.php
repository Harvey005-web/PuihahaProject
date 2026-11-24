<fieldset style="margin: 24px 0 20px; padding: 22px; border: 1px solid var(--border-medium); border-radius: 12px; background: #fafbfc;">
    <legend style="padding: 0 10px; font-weight: 700; font-size: 14px; color: var(--text-primary); display: flex; align-items: center; gap: 6px;">
        <span style="display: inline-block; width: 8px; height: 8px; background: var(--yellow-primary); border-radius: 2px;"></span>
        Application Location &amp; Local Weather
    </legend>
    <p style="font-size: 13.5px; color: var(--text-muted); margin-bottom: 16px;">
        Pinpoint the application filing coordinates or click on the map. Coordinates are optional.
    </p>

    <div class="grid" style="margin-bottom: 16px;">
        <div>
            <label for="latitude">Latitude</label>
            <input id="latitude" name="latitude" type="number" min="-90" max="90" step="any" value="{{ old('latitude', $transaction->latitude) }}" placeholder="14.599512" style="margin-bottom: 0;">
        </div>
        <div>
            <label for="longitude">Longitude</label>
            <input id="longitude" name="longitude" type="number" min="-180" max="180" step="any" value="{{ old('longitude', $transaction->longitude) }}" placeholder="120.984222" style="margin-bottom: 0;">
        </div>
    </div>

    <div id="location-map" style="height: 300px; border-radius: 8px; border: 1px solid var(--border-medium); overflow: hidden; margin-bottom: 12px; background: #e5e7eb;" role="region" aria-label="Choose application location"></div>

    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
        <div id="weather-status" role="status" style="display: inline-flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; padding: 6px 12px; background: var(--yellow-subtle); border: 1px solid var(--yellow-border); border-radius: 6px; color: var(--yellow-text);">
            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
            </svg>
            <span>Choose a location to load weather.</span>
        </div>
        <div id="map-status" role="status" style="font-size: 12.5px; color: var(--text-muted);"></div>
    </div>
</fieldset>

<script>
(() => {
    const latInput = document.getElementById('latitude'), lonInput = document.getElementById('longitude');
    const status = document.getElementById('weather-status'), mapStatus = document.getElementById('map-status');
    let map, pin, timer, pending;
    const valid = () => latInput.value !== '' && lonInput.value !== '' && latInput.checkValidity() && lonInput.checkValidity();
    const weather = async () => {
        if (pending) pending.abort();
        if (!valid()) {
            status.innerHTML = '<span>Enter coordinates to load weather preview.</span>';
            return;
        }
        const controller = new AbortController();
        pending = controller;
        status.innerHTML = '<span>Fetching weather details...</span>';
        try {
            const url = new URL(@json(route('weather.show')), window.location.origin);
            url.searchParams.set('lat', latInput.value);
            url.searchParams.set('lon', lonInput.value);
            const response = await fetch(url, { signal: controller.signal, headers: { Accept: 'application/json' } });
            const data = await response.json();
            if (!response.ok) throw new Error(data.message || 'Weather unavailable.');
            status.innerHTML = `<strong>${data.place}:</strong> ${data.temperature ?? '—'} °C, ${data.description}, Humidity ${data.humidity ?? '—'}%`;
        } catch (error) {
            if (error.name !== 'AbortError') {
                status.innerHTML = '<span>Weather preview unavailable for these coordinates.</span>';
            }
        }
    };
    const update = () => {
        if (valid() && map) {
            const position = { lat: Number(latInput.value), lng: Number(lonInput.value) };
            pin.position = position;
            pin.map = map;
            map.panTo(position);
        }
        clearTimeout(timer);
        timer = setTimeout(weather, 450);
    };
    [latInput, lonInput].forEach(input => input.addEventListener('input', update));
    window.initMembershipMap = async () => {
        const { AdvancedMarkerElement } = await google.maps.importLibrary('marker');
        const center = valid() ? { lat: Number(latInput.value), lng: Number(lonInput.value) } : { lat: 14.5995, lng: 120.9842 };
        map = new google.maps.Map(document.getElementById('location-map'), { center, zoom: 13, mapId: 'DEMO_MAP_ID' });
        pin = new AdvancedMarkerElement({ position: center, map: valid() ? map : null });
        map.addListener('click', event => {
            latInput.value = event.latLng.lat().toFixed(7);
            lonInput.value = event.latLng.lng().toFixed(7);
            update();
        });
    };
    window.gm_authFailure = () => {
        if (mapStatus) mapStatus.textContent = 'Google Maps authorization failed. Coordinates can still be typed manually.';
    };
    if (valid()) weather();
})();
</script>
@if(config('membership.google_maps_key'))
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ config('membership.google_maps_key') }}&amp;loading=async&amp;callback=initMembershipMap" onerror="document.getElementById('map-status').textContent='Google Maps could not load.'"></script>
@else
    <script>
        document.getElementById('location-map').style.display = 'none';
        document.getElementById('map-status').textContent = 'Interactive Google Map is disabled. You can enter latitude and longitude coordinates manually.';
    </script>
@endif
