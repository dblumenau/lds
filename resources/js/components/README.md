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

Components use:
- Scoped styles with `<style scoped>`
- Tailwind CSS utility classes
- Custom CSS for animations (e.g., card flips)