File.read!("../storage/app/1/a.txt")
|> String.trim()
|> String.split("\n")
|> Enum.map(fn line ->
  replacements = %{
    "one" => "one1one",
    "two" => "two2two",
    "three" => "three3three",
    "four" => "four4four",
    "five" => "five5five",
    "six" => "six6six",
    "seven" => "seven7seven",
    "eight" => "eight8eight",
    "nine" => "nine9nine"
  }

  Enum.reduce(replacements, line, fn {key, value}, acc ->
    String.replace(acc, key, value)
  end)
end)
|> Enum.map(fn arg -> String.graphemes(arg) end)
|> Enum.map(fn line ->
  line
  |> Enum.filter(&String.match?(&1, ~r/\d/)) # Filter out non-digits
  |> Enum.chunk_every(1, 1, :discard) # Split into chunks of 1
  |> fn digits ->  Enum.join([hd(digits), Enum.at(digits, -1)]) end.()
end)
|> Enum.map(&String.to_integer/1)
|> Enum.sum()
|> IO.inspect()
