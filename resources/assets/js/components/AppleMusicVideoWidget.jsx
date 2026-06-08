import { useState, useEffect } from 'preact/hooks';
import { fetchMusicVideo, makeThumbnail } from '../lib/appleMusicApi';
import './AppleMusicVideoWidget.scss';

export default function AppleMusicVideoWidget({ inputName = 'apple_music_video_id', payloadName = 'apple_music_video_payload_as_string' }) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(false);

  function loadVideo(videoId) {
    if (!window.apple_music_developer_token || !videoId) return;
    setLoading(true);
    setError(false);
    setData(null);
    fetchMusicVideo(videoId)
      .then(setData)
      .catch(() => setError(true))
      .finally(() => setLoading(false));
  }

  useEffect(() => {
    const inputEl = document.querySelector(`[name="${inputName}"]`);
    const payloadEl = document.querySelector(`[name="${payloadName}"]`);

    if (payloadEl?.value) {
      try {
        const parsed = JSON.parse(payloadEl.value);
        setData(parsed.data[0]);
      } catch (e) {
        console.error(e, 'Error parsing apple music video payload');
      }
    } else if (inputEl?.value) {
      loadVideo(inputEl.value);
    }

    if (!inputEl) return;
    let lastValue = inputEl.value;
    const interval = setInterval(() => {
      if (inputEl.value !== lastValue) {
        lastValue = inputEl.value;
        loadVideo(inputEl.value);
      }
    }, 500);
    return () => clearInterval(interval);
  }, []);

  if (!loading && !data && !error) return null;

  return (
    <div class="video-finder">
      <div data-load={loading ? 'loading' : 'loaded'}>
        {!loading && data && (
          <div class="video-finder__inner">
            {data.attributes.previews?.[0]?.url && (
              <div class="video-finder__video-wrapper">
                <video
                  src={data.attributes.previews[0].url}
                  poster={makeThumbnail(data.attributes.artwork.url, 800)}
                  width="100%"
                  controls
                />
              </div>
            )}
            <div>
              {data.attributes.artistName && <p><b>Artist:</b> {data.attributes.artistName}</p>}
              {data.attributes.albumName && <p><b>Album:</b> {data.attributes.albumName}</p>}
              {data.attributes.name && <p><b>Song:</b> {data.attributes.name}</p>}
            </div>
          </div>
        )}
        {!loading && error && (
          <div class="video-finder__inner">
            Sorry, we couldn't find a match for that Video ID.
          </div>
        )}
      </div>
    </div>
  );
}
