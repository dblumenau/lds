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
            :key="`left-${index}`"
            class="word-slot"
          >
            <div
              v-if="word"
              class="word-button"
              :class="{
                'selected': selectedLeft === index,
                'fading': word.fading,
                'fade-in': word.fadeIn
              }"
              @click="selectWord('left', index)"
            >
              {{ word.danish }}
            </div>
          </div>
        </div>

        <div class="word-column">
          <div
            v-for="(word, index) in rightWords"
            :key="`right-${index}`"
            class="word-slot"
          >
            <div
              v-if="word"
              class="word-button"
              :class="{
                'selected': selectedRight === index,
                'fading': word.fading,
                'error-flash': word.errorFlash,
                'fade-in': word.fadeIn
              }"
              @click="selectWord('right', index)"
            >
              {{ word.english }}
            </div>
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
      
      // Initialize arrays with 5 slots
      this.leftWords = new Array(5);
      this.rightWords = new Array(5);
      
      // Place words in slots
      this.currentWordPairs.forEach((word, index) => {
        this.leftWords[index] = { ...word };
      });
      
      // Shuffle right words
      const shuffledPairs = [...this.currentWordPairs].sort(() => Math.random() - 0.5);
      shuffledPairs.forEach((word, index) => {
        this.rightWords[index] = { ...word };
      });
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
      // Don't select null slots
      if (column === 'left' && !this.leftWords[index]) return;
      if (column === 'right' && !this.rightWords[index]) return;
      
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
      
      // After fade animation, mark slots as empty
      setTimeout(() => {
        // Mark slots as empty (null)
        this.leftWords[leftIndex] = null;
        this.rightWords[rightIndex] = null;
        
        // Schedule replacement after delay (2-4 seconds)
        const replacementDelay = 2000 + Math.random() * 2000;
        
        setTimeout(() => {
          if (this.nextPairIndex < this.allWordPairs.length) {
            // Get next word pair
            const nextPair = this.allWordPairs[this.nextPairIndex];
            this.nextPairIndex++;
            
            // Find random empty slots
            const emptyLeftIndices = this.leftWords
              .map((word, index) => word === null ? index : -1)
              .filter(index => index !== -1);
            const emptyRightIndices = this.rightWords
              .map((word, index) => word === null ? index : -1)
              .filter(index => index !== -1);
            
            if (emptyLeftIndices.length > 0 && emptyRightIndices.length > 0) {
              // Choose random empty slots
              const randomLeftIndex = emptyLeftIndices[Math.floor(Math.random() * emptyLeftIndices.length)];
              const randomRightIndex = emptyRightIndices[Math.floor(Math.random() * emptyRightIndices.length)];
              
              // Place new words with fade-in animation
              this.leftWords[randomLeftIndex] = { ...nextPair, fading: false, fadeIn: true };
              this.rightWords[randomRightIndex] = { ...nextPair, fading: false, fadeIn: true };
              
              // Remove fade-in class after animation
              setTimeout(() => {
                if (this.leftWords[randomLeftIndex]) {
                  this.leftWords[randomLeftIndex].fadeIn = false;
                }
                if (this.rightWords[randomRightIndex]) {
                  this.rightWords[randomRightIndex].fadeIn = false;
                }
              }, 500);
            }
          }
        }, replacementDelay);
        
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

<style lang="scss" scoped>
@use './MatchMadnessGame.scss' as *;
</style>