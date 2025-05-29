# Match Madness Delay Feature Planning

## Task Description
Modify the Match Madness game to introduce a 2-4 second delay before replacing matched pairs, allowing multiple empty slots and random placement of new pairs.

## Current Behavior Analysis
Based on the code review, the current implementation:
- Immediately replaces matched pairs in the same position
- Only allows one empty slot at a time
- Doesn't provide opportunity to clear multiple pairs before replacements

## Proposed Changes

### Core Requirements
1. **Delay System**: Add 2-4 second delay before replacing matched pairs
2. **Multiple Empty Slots**: Allow multiple card positions to be empty simultaneously
3. **Random Placement**: Place new pairs in random empty positions instead of fixed positions
4. **User Experience**: Enable fast players to potentially clear all 5 pairs before any replacements

### Technical Approach
1. Modify the card data structure to support null/empty positions
2. Implement a replacement queue with timestamps
3. Add logic to find and use random empty positions
4. Create visual feedback for empty slots

## Questions for Clarification

1. **Delay Duration**: Should the delay be exactly between 2-4 seconds (random within range) or a fixed delay? 
   - Current assumption: Random between 2-4 seconds for variety

2. **Visual Feedback**: How should empty card positions appear?
   - Option A: Completely invisible (gap in grid) - this one
   - Option B: Empty placeholder with border/shadow
   - Option C: Faded/ghosted card back

3. **Replacement Animation**: Should new cards fade in or appear instantly?
   - Current assumption: Fade in for better UX - yes fade in

4. **Game Mode**: Is this modifying the existing matching pairs game or creating a new "Match Madness" mode? - modifying the existing game
   - Current assumption: Modifying existing game based on context

5. **Edge Cases**: What happens if all positions become empty? Should we:
   - Wait for timers to expire naturally - yes 
   - Have a minimum number of active pairs (e.g., always keep at least 2 pairs visible) - no 
   - Immediately spawn some pairs if below threshold - no

6. **Pair Pool**: Should we continue using the same 8 word pairs cycling through, or expand the pool?
   - Current assumption: Keep existing word pairs - yes

## Success Criteria
- [x] Matched pairs remain visible for 2-4 seconds before removal
- [ ] Empty slots can exist simultaneously (multiple at once)
- [ ] New pairs appear in random empty positions
- [ ] Fast players can clear multiple pairs creating multiple empty slots
- [ ] Smooth animations and good visual feedback

## Implementation Plan
1. Update data structure to support null cards
2. Implement delayed removal with queue system  
3. Add random empty slot selection logic
4. Update rendering to handle empty slots
5. Add animations for removal and appearance
6. Test various play speeds and edge cases

## Potential Risks
- Performance with multiple timers running
- Visual confusion with many empty slots
- Timing balance (too easy/hard with delays)

Please review and provide answers to the clarification questions above, or modify this plan as needed.
