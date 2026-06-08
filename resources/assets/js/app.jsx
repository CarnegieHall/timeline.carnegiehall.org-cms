import { render } from 'preact';
import AppleMusicSongWidget from './components/AppleMusicSongWidget';
import AppleMusicVideoWidget from './components/AppleMusicVideoWidget';
import AppleMusicSearch from './components/AppleMusicSearch';

// Mount song finder widget
const songMount = document.getElementById('song-finder-widget');
if (songMount) {
  render(<AppleMusicSongWidget />, songMount);
}

// Mount video finder widget
const videoMount = document.getElementById('video-finder-widget');
if (videoMount) {
  render(<AppleMusicVideoWidget />, videoMount);
}

// Mount Apple Music search widget
const searchMount = document.getElementById('apple-music-search-widget');
if (searchMount) {
  render(<AppleMusicSearch />, searchMount);
}
