const BASE_URL = 'https://api.music.apple.com';

function getHeaders() {
  return {
    Authorization: `Bearer ${window.apple_music_developer_token}`,
  };
}

export async function fetchSong(songId) {
  const res = await fetch(`${BASE_URL}/v1/catalog/us/songs/${songId}`, {
    headers: getHeaders(),
  });
  if (!res.ok) throw new Error(res.statusText);
  const json = await res.json();
  return json.data[0];
}

export async function fetchMusicVideo(videoId) {
  const res = await fetch(`${BASE_URL}/v1/catalog/us/music-videos/${videoId}`, {
    headers: getHeaders(),
  });
  if (!res.ok) throw new Error(res.statusText);
  const json = await res.json();
  return json.data[0];
}

export async function search(type, term) {
  const res = await fetch(
    `${BASE_URL}/v1/catalog/us/search?types=${type}&term=${encodeURIComponent(term)}&limit=25`,
    { headers: getHeaders() }
  );
  if (!res.ok) throw new Error(res.statusText);
  return res.json();
}

export function makeThumbnail(url, size = 160) {
  return url.replace('{w}', size).replace('{h}', size);
}
