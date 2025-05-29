<template>
  <div class="match-madness-container">
    <!-- Game states -->
    <div v-if="gameState === 'intro'" class="intro-screen">
      <div class="intro-content">
        <h1 class="intro-title">Match Madness</h1>
        <p class="intro-description">
          Match Danish words with their English translations!
        </p>
        <p class="intro-instructions">
          Tap a word in the left column, then tap its matching translation in the right column.
          You have 60 seconds to match as many pairs as possible.
        </p>
        <button @click="startGame" class="start-button">
          Start Game
        </button>
      </div>
    </div>

    <div v-else-if="gameState === 'playing'" class="game-screen">
      <!-- Header with progress and timer -->
      <div class="game-header">
        <button @click="quitGame" class="close-button">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M15 5L5 15M5 5L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
        
        <div class="progress-bar">
          <div class="progress-fill" :style="{ width: progressPercentage + '%' }"></div>
        </div>
        
        <div class="timer">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="2"/>
            <path d="M10 6V10L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          {{ formattedTime }}
        </div>
      </div>

      <!-- Title -->
      <h2 class="game-title">Tap the matching pairs</h2>

      <!-- Word columns -->
      <div class="words-container">
        <div class="word-column">
          <div
            v-for="(word, index) in leftWords"
            :key="word.id"
            class="word-button"
            :class="{
              'selected': selectedLeft === index,
              'fading': word.fading
            }"
            @click="selectWord('left', index)"
          >
            {{ word.danish }}
          </div>
        </div>

        <div class="word-column">
          <div
            v-for="(word, index) in rightWords"
            :key="word.id"
            class="word-button"
            :class="{
              'selected': selectedRight === index,
              'fading': word.fading,
              'error-flash': word.errorFlash
            }"
            @click="selectWord('right', index)"
          >
            {{ word.english }}
          </div>
        </div>
      </div>
    </div>

    <div v-else-if="gameState === 'finished'" class="results-screen">
      <div class="results-content">
        <h1 class="results-title">
          {{ completedAll ? 'Genius!' : 'Time\'s Up!' }}
        </h1>
        
        <div v-if="completedAll" class="genius-message">
          Wow! You matched all 30 pairs in {{ 60 - timeLeft }} seconds!
        </div>
        
        <div class="results-stats">
          <p class="matches-made">Matches made: {{ matchesCompleted }}/30</p>
          <p v-if="!completedAll" class="matches-left">Matches left: {{ 30 - matchesCompleted }}</p>
        </div>
        
        <button @click="resetGame" class="play-again-button">
          Play Again
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      gameState: 'intro', // intro, playing, finished
      timeLeft: 60,
      timerInterval: null,
      matchesCompleted: 0,
      completedAll: false,
      
      // Word management
      allWordPairs: [],
      currentWordPairs: [],
      leftWords: [],
      rightWords: [],
      nextPairIndex: 5,
      
      // Selection state
      selectedLeft: null,
      selectedRight: null,
    };
  },
  
  computed: {
    formattedTime() {
      const minutes = Math.floor(this.timeLeft / 60);
      const seconds = this.timeLeft % 60;
      return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    },
    
    progressPercentage() {
      return (this.matchesCompleted / 30) * 100;
    }
  },
  
  mounted() {
    this.loadWords();
  },
  
  beforeUnmount() {
    if (this.timerInterval) {
      clearInterval(this.timerInterval);
    }
  },
  
  methods: {
    async loadWords() {
      try {
        // For now, using dummy data. In production, this would fetch from the API
        // const response = await fetch('/api/words');
        // const words = await response.json();
        
        // Dummy data for testing
        const dummyWords = [
          { danish: 'hej', english: 'hello' },
          { danish: 'farvel', english: 'goodbye' },
          { danish: 'tak', english: 'thanks' },
          { danish: 'ja', english: 'yes' },
          { danish: 'nej', english: 'no' },
          { danish: 'vand', english: 'water' },
          { danish: 'mad', english: 'food' },
          { danish: 'hus', english: 'house' },
          { danish: 'bil', english: 'car' },
          { danish: 'bog', english: 'book' },
          { danish: 'ven', english: 'friend' },
          { danish: 'familie', english: 'family' },
          { danish: 'arbejde', english: 'work' },
          { danish: 'skole', english: 'school' },
          { danish: 'tid', english: 'time' },
          { danish: 'dag', english: 'day' },
          { danish: 'nat', english: 'night' },
          { danish: 'morgen', english: 'morning' },
          { danish: 'aften', english: 'evening' },
          { danish: 'sol', english: 'sun' },
          { danish: 'måne', english: 'moon' },
          { danish: 'stjerne', english: 'star' },
          { danish: 'himmel', english: 'sky' },
          { danish: 'jord', english: 'earth' },
          { danish: 'hav', english: 'sea' },
          { danish: 'bjerg', english: 'mountain' },
          { danish: 'skov', english: 'forest' },
          { danish: 'træ', english: 'tree' },
          { danish: 'blomst', english: 'flower' },
          { danish: 'dyr', english: 'animal' },
        ];
        
        // Shuffle and select 30 pairs
        const shuffled = [...dummyWords].sort(() => Math.random() - 0.5);
        this.allWordPairs = shuffled.slice(0, 30).map((pair, index) => ({
          ...pair,
          id: index,
          fading: false,
          errorFlash: false
        }));
        
      } catch (error) {
        console.error('Error loading words:', error);
      }
    },
    
    startGame() {
      this.setupInitialWords();
      this.gameState = 'playing';
      this.startTimer();
    },
    
    setupInitialWords() {
      // Get first 5 pairs
      this.currentWordPairs = this.allWordPairs.slice(0, 5);
      
      // Separate and shuffle left and right words
      this.leftWords = [...this.currentWordPairs];
      this.rightWords = [...this.currentWordPairs].sort(() => Math.random() - 0.5);
    },
    
    startTimer() {
      this.timerInterval = setInterval(() => {
        this.timeLeft--;
        if (this.timeLeft <= 0) {
          this.endGame();
        }
      }, 1000);
    },
    
    selectWord(column, index) {
      if (column === 'left') {
        if (this.selectedLeft === index) {
          this.selectedLeft = null;
        } else {
          this.selectedLeft = index;
          if (this.selectedRight !== null) {
            this.checkMatch();
          }
        }
      } else {
        if (this.selectedRight === index) {
          this.selectedRight = null;
        } else {
          this.selectedRight = index;
          if (this.selectedLeft !== null) {
            this.checkMatch();
          }
        }
      }
    },
    
    checkMatch() {
      const leftWord = this.leftWords[this.selectedLeft];
      const rightWord = this.rightWords[this.selectedRight];
      
      if (leftWord.id === rightWord.id) {
        // Correct match
        this.handleCorrectMatch();
      } else {
        // Incorrect match
        this.handleIncorrectMatch();
      }
    },
    
    handleCorrectMatch() {
      const leftIndex = this.selectedLeft;
      const rightIndex = this.selectedRight;
      
      // Mark words as fading
      this.leftWords[leftIndex].fading = true;
      this.rightWords[rightIndex].fading = true;
      
      // Clear selection
      this.selectedLeft = null;
      this.selectedRight = null;
      
      // Increment matches
      this.matchesCompleted++;
      
      // After fade animation, replace with new words
      setTimeout(() => {
        if (this.nextPairIndex < this.allWordPairs.length) {
          // Get next word pair
          const nextPair = this.allWordPairs[this.nextPairIndex];
          this.nextPairIndex++;
          
          // Replace the faded words
          this.$set(this.leftWords, leftIndex, { ...nextPair, fading: false });
          this.$set(this.rightWords, rightIndex, { ...nextPair, fading: false });
        } else {
          // No more words, remove the slots
          this.leftWords[leftIndex] = { danish: '', english: '', id: -1, fading: true };
          this.rightWords[rightIndex] = { danish: '', english: '', id: -1, fading: true };
        }
        
        // Check if all matches completed
        if (this.matchesCompleted === 30) {
          this.completedAll = true;
          this.endGame();
        }
      }, 400);
    },
    
    handleIncorrectMatch() {
      // Flash error on right word
      this.rightWords[this.selectedRight].errorFlash = true;
      
      // Clear selections after brief delay
      setTimeout(() => {
        this.rightWords[this.selectedRight].errorFlash = false;
        this.selectedLeft = null;
        this.selectedRight = null;
      }, 300);
    },
    
    endGame() {
      clearInterval(this.timerInterval);
      this.gameState = 'finished';
    },
    
    quitGame() {
      if (confirm('Are you sure you want to quit?')) {
        clearInterval(this.timerInterval);
        this.resetGame();
      }
    },
    
    resetGame() {
      // Reset all state
      this.gameState = 'intro';
      this.timeLeft = 60;
      this.matchesCompleted = 0;
      this.completedAll = false;
      this.selectedLeft = null;
      this.selectedRight = null;
      this.nextPairIndex = 5;
      this.leftWords = [];
      this.rightWords = [];
      
      // Reload and shuffle words
      this.loadWords();
    }
  }
};
</script>

<style scoped>
.match-madness-container {
  max-width: 425px;
  margin: 0 auto;
  padding: 20px;
  min-height: 100vh;
  background-color: #f5f5f5;
}

/* Intro Screen */
.intro-screen {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 20px;
}

.intro-content {
  text-align: center;
  background: white;
  padding: 40px;
  border-radius: 16px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.intro-title {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 16px;
  color: #1f2937;
}

.intro-description {
  font-size: 18px;
  color: #4b5563;
  margin-bottom: 24px;
}

.intro-instructions {
  font-size: 16px;
  color: #6b7280;
  margin-bottom: 32px;
  line-height: 1.5;
}

.start-button {
  background-color: #3b82f6;
  color: white;
  font-size: 18px;
  font-weight: 600;
  padding: 12px 32px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.start-button:hover {
  background-color: #2563eb;
}

/* Game Screen */
.game-screen {
  background: white;
  border-radius: 16px;
  padding: 20px;
  min-height: calc(100vh - 40px);
}

.game-header {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 24px;
}

.close-button {
  background: none;
  border: none;
  color: #6b7280;
  cursor: pointer;
  padding: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.close-button:hover {
  color: #4b5563;
}

.progress-bar {
  flex: 1;
  height: 12px;
  background-color: #e5e7eb;
  border-radius: 6px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background-color: #10b981;
  transition: width 0.3s ease;
}

.timer {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 18px;
  font-weight: 600;
  color: #4b5563;
}

.game-title {
  text-align: center;
  font-size: 24px;
  font-weight: 600;
  color: #4b5563;
  margin-bottom: 32px;
}

/* Word Columns */
.words-container {
  display: flex;
  gap: 20px;
}

.word-column {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.word-button {
  background-color: #e5e7eb;
  color: #1f2937;
  font-size: 18px;
  padding: 20px;
  border-radius: 12px;
  text-align: center;
  cursor: pointer;
  transition: all 0.2s;
  user-select: none;
}

.word-button:hover {
  background-color: #d1d5db;
}

.word-button.selected {
  background-color: #3b82f6;
  color: white;
}

.word-button.fading {
  opacity: 0;
  transform: scale(0.95);
  transition: all 0.4s ease;
}

.word-button.error-flash {
  background-color: #ef4444 !important;
  color: white;
  animation: errorFlash 0.3s;
}

@keyframes errorFlash {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(0.95); }
}

/* Results Screen */
.results-screen {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 20px;
}

.results-content {
  text-align: center;
  background: white;
  padding: 40px;
  border-radius: 16px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.results-title {
  font-size: 36px;
  font-weight: bold;
  margin-bottom: 16px;
  color: #1f2937;
}

.genius-message {
  font-size: 20px;
  color: #10b981;
  margin-bottom: 24px;
  font-weight: 600;
}

.results-stats {
  margin-bottom: 32px;
}

.matches-made {
  font-size: 24px;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 8px;
}

.matches-left {
  font-size: 18px;
  color: #6b7280;
}

.play-again-button {
  background-color: #3b82f6;
  color: white;
  font-size: 18px;
  font-weight: 600;
  padding: 12px 32px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.play-again-button:hover {
  background-color: #2563eb;
}
</style>