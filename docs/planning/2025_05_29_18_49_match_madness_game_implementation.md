# Match Madness Game Implementation Planning

## Task Overview
Implement the Match Madness word-matching game as specified in `docs/planning/match_game_rules.md`. This is a fast-paced game where players connect word pairs from two columns under time pressure.

## Current Understanding (Updated from your answers)
- This is a NEW game, different from the existing Matching Pairs memory card game
- Core mechanic: TAP-ONLY interaction (tap one word, then tap its match)
- Fixed 60-second timer per game
- Always 5 visible word pairs
- Total of 30 matches per game
- When a match is made, words fade out and new ones fade in (until all 30 are used)
- Mobile-optimized for 425px screens
- No audio for MVP
- No complex scoring system yet - just track correct matches
- No hover states, no drag-and-drop, no haptic feedback

## Clarifications Summary

### 1. Integration and Navigation
- Accessible from existing games index page (`/games`) ✓
- Route: `/games/match-madness` ✓
- No authentication required (only word upload requires auth) ✓

### 2. Word Data Source
- Uses same word data from word upload feature ✓
- Randomly selects 30 pairs from available words ✓
- Categories feature planned for future ✓

### 3. Game Flow
- Results screen shows matches made (X/30) ✓
- Special "genius" message if all 30 matched before time ✓
- "Play Again" option with new random pairs ✓
- Intro screen with instructions ✓

### 4. Technical Architecture
- Vue component (MatchMadnessGame.vue) ✓
- No database storage needed ✓

### 5. Visual Design
- Custom design based on provided mockup ✓
- Fade animation duration: 400ms ✓
- New words appear in same position as faded ones ✓
- Clean gray rounded buttons with dark text ✓
- Selected state: highlight/border indication ✓

### 6. Error Handling
- Incorrect match: deselect both ✓
- Subtle red flash for errors ✓
- Player can tap to deselect ✓

## Proposed Implementation Approach

### Phase 1: Core Game Mechanics
1. Create Vue component `MatchMadnessGame.vue`
2. Implement two-column layout (5 pairs visible)
3. Add tap-to-select logic
4. Implement word matching validation
5. Add fade out/fade in animations for completed matches

### Phase 2: Game Flow
1. Add 60-second countdown timer
2. Implement word pool management (30 total pairs)
3. Add game start/end states
4. Track correct matches count

### Phase 3: Polish
1. Add visual feedback for selections and errors
2. Optimize for 425px mobile screens
3. Add any additional animations
4. Implement "Play Again" functionality

## Success Criteria
- Game displays exactly 5 word pairs at all times
- Tap-to-select matching works smoothly
- 60-second timer counts down properly
- Matched pairs fade out and are replaced with new pairs
- Game handles all 30 word pairs correctly
- Works well on 425px mobile screens
- Clear visual feedback for user actions

## Implementation Plan Summary

All clarifications have been received! Here's the final implementation plan:

### Game Features
- **Route**: `/games/match-madness`
- **UI**: Based on provided mockup with progress bar, timer, and two columns
- **Interaction**: Tap-only (tap word 1, then tap word 2 to match)
- **Word Data**: Random 30 Danish-English pairs from uploaded words
- **Game Flow**: 60-second timer, 5 visible pairs at all times
- **Animations**: 400ms fade out/in, same position replacement
- **Results**: Show matches made (X/30), special message for completion

### Technical Decisions
- Vue component architecture
- No database storage
- No authentication required
- Uses existing word upload data

## Ready to Begin Implementation
With all questions answered, we can now proceed with building the Match Madness game following the specifications and mockup provided.
