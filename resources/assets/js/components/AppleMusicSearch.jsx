import { useState, useEffect } from 'preact/hooks';
import { search, makeThumbnail } from '../lib/appleMusicApi';
import './AppleMusicSearch.scss';

export default function AppleMusicSearch() {
  const [term, setTerm] = useState('');
  const [type, setType] = useState('songs');
  const [loading, setLoading] = useState(false);
  const [songs, setSongs] = useState([]);
  const [musicVideos, setMusicVideos] = useState([]);
  const [error, setError] = useState(false);
  const [tokenMissing, setTokenMissing] = useState(false);

  useEffect(() => {
    if (!window.apple_music_developer_token) {
      setTokenMissing(true);
    }
  }, []);

  useEffect(() => {
    setSongs([]);
    setMusicVideos([]);
    if (!window.apple_music_developer_token || !term.length) return;

    setLoading(true);
    setError(false);
    search(type, term)
      .then((json) => {
        setSongs(json.results?.songs?.data || []);
        setMusicVideos(json.results?.['music-videos']?.data || []);
      })
      .catch(() => setError(true))
      .finally(() => setLoading(false));
  }, [term, type]);

  return (
    <div>
      <div class="apple-music-search">
        <input
          type="search"
          class="form__input form__input--small"
          placeholder="Search US Apple Music Library..."
          value={term}
          onInput={(e) => setTerm(e.target.value)}
        />
        <select
          class="form__input form__input--small select__input"
          value={type}
          onChange={(e) => setType(e.target.value)}
        >
          <option value="songs">Songs</option>
          <option value="music-videos">Music Videos</option>
        </select>

        {(!loading && (songs.length > 0 || musicVideos.length > 0)) && (
          <div class="results">
            {songs.length > 0 && (
              <>
                <div class="title">Songs</div>
                {songs.map((song) => (
                  <div class="result" key={song.id}>
                    <div><img src={makeThumbnail(song.attributes.artwork.url)} /></div>
                    <div>
                      <p>{song.attributes.name}</p>
                      <p><b>Artist:</b> {song.attributes.artistName || '(empty)'}</p>
                      <p><b>Album:</b> {song.attributes.albumName || '(empty)'}</p>
                      <p><b>Released:</b> {song.attributes.releaseDate || '(empty)'}</p>
                      <p class="id"># {song.id}</p>
                    </div>
                  </div>
                ))}
              </>
            )}
            {musicVideos.length > 0 && (
              <>
                <div class="title">Music Videos</div>
                {musicVideos.map((mv) => (
                  <div class="result" key={mv.id}>
                    <div><img src={makeThumbnail(mv.attributes.artwork.url)} /></div>
                    <div>
                      <p>{mv.attributes.name}</p>
                      <p><b>Artist:</b> {mv.attributes.artistName || '(empty)'}</p>
                      <p><b>Album:</b> {mv.attributes.albumName || '(empty)'}</p>
                      <p><b>Released:</b> {mv.attributes.releaseDate || '(empty)'}</p>
                      <p class="id"># {mv.id}</p>
                    </div>
                  </div>
                ))}
              </>
            )}
          </div>
        )}
      </div>

      {!loading && tokenMissing && (
        <div class="apple-music-search__warning">
          ⚠ Apple Music developer token is missing or expired. Search is unavailable until the token is renewed.
        </div>
      )}

      {!loading && error && (
        <div>Sorry, we couldn't find any results matching your search term.</div>
      )}
    </div>
  );
}
