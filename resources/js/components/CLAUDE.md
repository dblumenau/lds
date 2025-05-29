# Vue Components Documentation

This directory contains Vue 3 components used to add interactivity to the Laravel application.

## Components

### `MatchingPairsGame.vue`
A memory card game for learning Danish-English word pairs.

#### Features:
- 4x4 grid layout (16 cards total)
- 8 Danish-English word pairs
- Card flip animations using CSS transforms
- Match detection logic
- Progress tracking with visual progress bar
- Game completion screen with replay option

#### Data Structure:
```javascript
wordPairs: [
    { danish: 'Hej', english: 'Hello' },
    { danish: 'Far', english: 'Father' },
    // ... more pairs
]
```

#### Game States:
- `flippedCards` - Tracks currently flipped cards (max 2)
- `matchedPairs` - Counter for successfully matched pairs
- `gameCompleted` - Boolean flag for game end state

#### Methods:
- `initializeGame()` - Sets up cards and shuffles them
- `flipCard(index)` - Handles card selection
- `checkForMatch()` - Validates if two flipped cards match
- `resetGame()` - Restarts the game

### `MatchMadnessGame.vue`
A fast-paced word matching game where players race against time to match Danish-English word pairs.

#### Features:
- 60-second countdown timer
- Progressive difficulty with 30 total word pairs
- Displays 5 pairs at a time
- **Delayed replacement system**: Matched pairs disappear after fade animation, then new pairs appear in random empty slots after 2-4 seconds
- Empty slots maintain layout stability (no content shifting)
- Fade in/out animations for smooth transitions
- Error feedback for incorrect matches
- Progress bar showing completion percentage
- Three game states: intro, playing, finished

#### Data Structure:
```javascript
allWordPairs: [
    { danish: 'hej', english: 'hello', id: 0 },
    { danish: 'farvel', english: 'goodbye', id: 1 },
    // ... 30 pairs total
]
```

#### Game States:
- `gameState` - 'intro' | 'playing' | 'finished'
- `selectedLeft` / `selectedRight` - Track selected words
- `leftWords` / `rightWords` - Arrays of current visible words (can contain null for empty slots)
- `nextPairIndex` - Tracks which pair to add next
- `matchesCompleted` - Counter for matched pairs
- `timeLeft` - Countdown timer in seconds

#### Key Methods:
- `setupInitialWords()` - Initializes the game with first 5 pairs
- `selectWord(column, index)` - Handles word selection
- `handleCorrectMatch()` - Processes matches with delay system
- `handleIncorrectMatch()` - Shows error feedback
- Random placement logic for new words in empty slots

#### Styling:
- Uses external SCSS file: `MatchMadnessGame.scss`
- Follows Vue 3 best practice for style management

### `ExampleComponent.vue`
A sample component demonstrating Vue integration (can be removed).

## Component Registration

Components are auto-registered in `app.js` using Vite's glob import:
```javascript
const components = import.meta.glob('./components/**/*.vue', { eager: true });
```

This means any `.vue` file in this directory is automatically available as a component without manual registration.

## Usage in Blade Templates

Components are used within a Vue mount point:
```blade
<div id="vue-app">
    <matching-pairs-game></matching-pairs-game>
</div>
```

## Styling

Components follow Vue 3 best practices:
- Simple components: Scoped styles with `<style scoped>`
- Complex components: External SCSS with `<style lang="scss" scoped>` importing `./ComponentName.scss`
- All use Tailwind CSS utility classes where appropriate
- Custom CSS for animations (e.g., card flips, fade effects)

## Development Requirements

- Ensure `sass-embedded` is installed for SCSS compilation: `npm install -D sass-embedded`