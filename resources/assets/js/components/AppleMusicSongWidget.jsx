import { useState, useEffect } from 'preact/hooks';
import { fetchSong, makeThumbnail } from '../lib/appleMusicApi';
import './AppleMusicSongWidget.scss';

export default function AppleMusicSongWidget({ inputName = 'apple_music_song_id', payloadName = 'apple_music_payload_as_string' }) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(false);

  function loadSong(songId) {
    if (!window.apple_music_developer_token || !songId) return;
    setLoading(true);
    setError(false);
    setData(null);
    fetchSong(songId)
      .then(setData)
      .catch(() => setError(true))
      .finally(() => setLoading(false));
  }

  useEffect(() => {
    const inputEl = document.querySelector(`[name="${inputName}"]`);
    const payloadEl = document.querySelector(`[name="${payloadName}"]`);

    // Try to load from existing payload first
    if (payloadEl?.value) {
      try {
        const parsed = JSON.parse(payloadEl.value);
        setData(parsed.data[0]);
      } catch (e) {
        console.error(e, 'Error parsing apple music payload');
      }
    } else if (inputEl?.value) {
      loadSong(inputEl.value);
    }

    // Watch for input changes (Twill sets value programmatically)
    if (!inputEl) return;
    let lastValue = inputEl.value;
    const interval = setInterval(() => {
      if (inputEl.value !== lastValue) {
        lastValue = inputEl.value;
        loadSong(inputEl.value);
      }
    }, 500);
    return () => clearInterval(interval);
  }, []);

  if (!loading && !data && !error) return null;

  return (
    <div class="song-finder">
      <div data-load={loading ? 'loading' : 'loaded'}>
        {!loading && data && (
          <div class="song-finder__inner">
            {data.attributes?.artwork && (
              <div>
                <img
                  src={makeThumbnail(data.attributes.artwork.url)}
                  class="song-finder__album-art"
                  width="80"
                />
              </div>
            )}
            <div>
              {data.attributes.artistName && <div><b>Artist:</b> {data.attributes.artistName}</div>}
              {data.attributes.albumName && <div><b>Album:</b> {data.attributes.albumName}</div>}
              {data.attributes.name && <div><b>Song:</b> {data.attributes.name}</div>}
            </div>
            {data.attributes.previews?.[0]?.url && (
              <div>
                <audio src={data.attributes.previews[0].url} controls />
              </div>
            )}
          </div>
        )}
        {!loading && error && (
          <div class="song-finder__inner">
            Sorry, we couldn't find a match for that Song ID.
          </div>
        )}
      </div>
    </div>
  );
}
