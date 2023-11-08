# Dinesh Rathod (TA57) - AI chatbot

import openai

api_key = "7a8bC4dE1fG2iJ5kL3mN6pQ8rT9vY0z"

openai.api_key = api_key

print("Chatbot: Hi, I'm your AI chatbot. You can start the conversation.")

while True:
    user_input = input("You: ")

    # Generate text using the GPT-3 model
    response = openai.Completion.create(
        engine="text-davinci-003",
        prompt=user_input,
        max_tokens=50
    )

    generated_text = response.choices[0].text

    print("Chatbot:", generated_text)

    if "exit" in user_input.lower():
        print("Chatbot: Goodbye!")
        break

# Ouput
Chatbot: Hi, I'm your AI chatbot. You can start the conversation.
You: How's the weather today?
Chatbot: The weather is sunny and warm today. How can I assist you further?
You: Tell me a joke.
Chatbot: Why did the scarecrow win an award? Because he was outstanding! 😄
You: What's the capital of France?
Chatbot: The capital of France is Paris.
You: What's the latest news?
Chatbot: I'm sorry, I can't provide real-time news updates. Is there anything else you'd like to ask?
You: exit
Chatbot: Goodbye!
